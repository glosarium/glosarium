<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Api\Beta\Glosarium;

use App\Glosarium\Category;
use App\Glosarium\Word;
use App\Http\Controllers\Api\Beta\ApiController;
use App\Jobs\Glosarium\ApiRequest;
use App\Notifications\Glosarium\WordCreatedNotification;
use App\Transformers\Glosarium\WordTransformer;
use App\User;
use Cache;
use JWTAuth;
use Notification;
use Validator;

class WordController extends ApiController
{
    private $lifetime;

    public function __construct()
    {
        $this->lifetime = \Carbon\Carbon::now()->addDays(30);

        if (JWTAuth::getToken()) {
            $this->user = JWTAuth::parseToken()->authenticate();
        }
    }

    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'limit' => 'integer|between:1,25',
            'sort'  => 'string|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->fails(), 422);
        }

        $key = sprintf('api.glosarium.index.%s', request('page', 0));

        $words = Cache::remember($key, $this->lifetime, function () {
            return $words = Word::with('category', 'description')
                ->orderBy('origin', request('sort', 'ASC'))
                ->paginate(request('limit', 20));
        });

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path() . '?' . http_build_query(request()->except('token')),
            'headers'  => $this->headers,
            'response' => $words,
        ]));

        // transform word
        $wordTransform = fractal($words, new WordTransformer())->toArray();

        return response()
            ->json($wordTransform)
            ->withHeaders($this->headers);
    }

    public function show($slug)
    {
        $key = sprintf('api.glosarium.word.%s', $slug);

        $word = Cache::remember($key, $this->lifetime, function () use ($slug) {
            return Word::whereSlug($slug)
                ->with('category', 'description')
                ->first();
        });

        if (empty($word)) {
            return response()->json([], 404);
        }

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path(),
            'headers'  => $this->headers,
            'response' => $word,
        ]));

        // transform word
        $wordTransform = fractal($word, new WordTransformer)->toArray();

        return response()
            ->json($wordTransform)
            ->withHeaders($this->headers);
    }

    public function search()
    {
        $validator = Validator::make(request()->all(), [
            'keyword' => 'required|string',
            'limit'   => 'integer|between:1,25',
            'sort'    => 'string|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $words = Word::filter()
            ->sort(request('sort', 'ASC'))
            ->paginate(request('limit', 20));

        $words->appends(request()->all());

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path() . '?' . http_build_query(request()->except('token')),
            'headers'  => $this->headers,
            'response' => $words,
        ]));

        // transform word
        $wordTransform = fractal($words, new WordTransformer)->toArray();

        return response()
            ->json($wordTransform)
            ->withHeaders($this->headers);
    }

    public function random()
    {
        $word = Word::inRandomOrder()
            ->with('category', 'description')
            ->whereHas('category', function ($query) {
                if (request('category')) {
                    return $query->whereSlug(request('category'));
                }

                return $query;
            })
            ->first();

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path() . '?' . http_build_query(request()->except('token')),
            'headers'  => $this->headers,
            'response' => $word,
        ]));

        // transform word
        $wordTransform = fractal($word, new WordTransformer)->toArray();

        return response()->json($wordTransform);
    }

    public function propose()
    {
        $validator = Validator::make(request()->all(), [
            'category' => 'required|string|exists:glosarium_categories,slug',
            'lang'     => 'required|max:3|string',
            'origin'   => 'required|string',
            'locale'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // find category
        $category = Category::whereSlug(request('category'))->first();
        if (empty($category)) {
            return response()->json(['error' => trans('glosarium.category.notFound')], 404);
        }

        $word = Word::create([
            'user_id'      => $this->user->id,
            'category_id'  => $category->id,
            'lang'         => request('lang'),
            'origin'       => request('origin'),
            'locale'       => request('locale'),
            'is_published' => false,
            'is_standard'  => false,
        ]);

        // transform word
        $wordTransform = fractal($word, new WordTransformer)->toArray();

        // send notifications
        $users = User::whereType('admin')->get();
        Notification::send($users, new WordCreatedNotification($word, $this->user->name));

        return response()
            ->json($wordTransform)
            ->withHeaders($this->headers);
    }
}
