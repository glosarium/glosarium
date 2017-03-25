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

namespace App\Http\Controllers\Api\Glosarium;

use App\Glosarium\Category;
use App\Http\Controllers\Api\ApiController;
use App\Jobs\Glosarium\ApiRequest;
use Cache;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class CategoryController extends ApiController
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
            return response()
                ->json($validator->errors(), 422)
                ->withHeaders($this->headers);
        }

        $key = sprintf('api.glosarium.category.index.%s', request('page', 0));

        $categories = Cache::remember($key, $this->lifetime, function () {
            return Category::orderBy('name', request('sort', 'ASC'))
                ->paginate(request('limit', 20));
        });

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path() . '?' . http_build_query(request()->except('token')),
            'method'   => 'get',
            'headers'  => $this->headers,
            'response' => $categories,
        ]));

        return response()
            ->json($categories)
            ->withHeaders($this->headers);
    }

    public function show($slug)
    {
        $key = sprintf('api.glosarium.category.%s', $slug);

        $category = Cache::remember($key, $this->lifetime, function () use ($slug) {
            return Category::whereSlug(trim($slug))
                ->withCount('words')
                ->first();
        });

        if (empty($category)) {
            return response()
                ->json(['error' => trans('glosarium.category.notFound')], 404)
                ->withHeaders($this->headers);
        }

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path(),
            'headers'  => $this->headers,
            'response' => $category,
        ]));

        return response()
            ->json($category)
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

        $categories = Category::filter()
            ->sort(request('sort', 'ASC'))
            ->paginate(request('limit', 20));

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path() . '?' . http_build_query(request()->except('token')),
            'headers'  => $this->headers,
            'response' => $categories,
        ]));

        return response()
            ->json($categories)
            ->withHeaders($this->headers);
    }

    public function random()
    {
        $category = Category::inRandomOrder()
            ->withCount('words')
            ->first();

        dispatch(new ApiRequest([
            'user_id'  => $this->user->id,
            'uri'      => request()->path() . '?' . http_build_query(request()->except('token')),
            'headers'  => $this->headers,
            'response' => $category,
        ]));

        return response()->json($category);
    }
}
