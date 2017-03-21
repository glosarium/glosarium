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

use App\Glosarium\Word;
use App\Http\Controllers\Api\ApiController;
use Cache;
use Validator;

class WordController extends ApiController
{
    private $lifetime;

    public function __construct()
    {
        $this->lifetime = \Carbon\Carbon::now()->addDays(30);
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

        return response()
            ->json($words)
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

        return response()
            ->json($word)
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

        return response()
            ->json($words)
            ->withHeaders($this->headers);
    }

    public function propose()
    {
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required|integer|exists:glosarium_categories,id',
            'lang'        => 'required|max:3|string',
            'origin'      => 'required|string',
            'locale'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return response()
            ->json(request()->all())
            ->withHeaders($this->headers);
    }
}
