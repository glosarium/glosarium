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
use Illuminate\Http\Request;
use Validator;

class CategoryController extends ApiController
{
    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'limit' => 'integer|between:1,25',
            'sort'  => 'string|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $categories = Category::orderBy('name', request('sort', 'ASC'))
            ->paginate(request('limit', 20));

        return response()
            ->json($categories)
            ->withHeaders($this->headers);
    }

    public function show($slug)
    {
        $category = Category::whereSlug(trim($slug))
            ->withCount('words')
            ->first();

        if (empty($category)) {
            return response()->json([], 404);
        }

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

        return response()
            ->json($categories)
            ->withHeaders($this->headers);
    }
}
