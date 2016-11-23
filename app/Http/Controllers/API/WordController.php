<?php

namespace App\Http\Controllers\API;

use App\Glosarium\Word;
use App\Glosarium\WordSearch;
use App\Http\Controllers\Controller;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class WordController extends Controller
{
    /**
     * Search glosarium by a word
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return mixed
     */
    public function search()
    {
        $validator = \Validator::make(request()->all(), [
            'word'  => 'required|string',
            'limit' => 'integer',
        ]);

        if ($validator->fails()) {
            return [
                'status'   => false,
                'contents' => $validator->errors(),
            ];
        }

        $limit = empty(request('limit')) ? 500 : (int) request('limit');

        $words = Word::where('foreign', 'LIKE', '%' . request('word') . '%')
            ->orWhere('locale', 'LIKE', '%' . request('word') . '%')
            ->whereStatus('published')
            ->limit($limit)
            ->with('category', 'descriptions.type')
            ->get();

        // save to search
        if (strlen(request('word')) >= 3) {
            WordSearch::insert([
                'source'     => 'api',
                'keyword'    => request('word'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return [
            'success'  => true,
            'total'    => $words->count(),
            'contents' => $words->map(function ($word) {
                return [
                    'category'   => $word->category->name,
                    'foreign'    => $word->foreign,
                    'locale'     => $word->locale,
                    'spell'      => $word->spell,
                    'createdAt'  => $word->created_at->toIso8601String(),
                    'updatedAt'  => $word->updated_at->toIso8601String(),
                    'totalViews' => $word->views()->count(),
                ];
            }),
        ];
    }
}
