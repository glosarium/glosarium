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
            'word' => 'required|string',
        ]);

        if ($validator->fails()) {
            return [
                'status'   => false,
                'contents' => $validator->errors(),
            ];
        }

        $words = Word::where('origin', 'LIKE', '%' . request('word') . '%')
            ->orWhere('glosarium', 'LIKE', '%' . request('word') . '%')
            ->whereStatus('published')
            ->with('descriptions', 'type')
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
                    'wordType'     => $word->type->name,
                    'origin'       => $word->origin,
                    'glosarium'    => $word->glosarium,
                    'spell'        => $word->spell,
                    'createdAt'    => $word->created_at->toIso8601String(),
                    'updatedAt'    => $word->updated_at->toIso8601String(),
                    'descriptions' => $word->descriptions->map(function ($description) {
                        return [$description->description];
                    }),
                ];
            }),
        ];
    }
}
