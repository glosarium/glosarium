<?php

namespace App\Http\Controllers\User\Glosarium;

use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function paginate()
    {
        $words = Word::orderBy('origin', 'ASC')
            ->orderBy('locale', 'ASC')
            ->with('category')
            ->paginate(request('limit', 20));

        if (request()->all()) {
            $words->appends(request()->all());
        }

        return response()->json($words);
    }

    public function moderation()
    {
        $words = Word::orderBy('origin', 'ASC')
            ->orderBy('locale', 'ASC')
            ->with('category')
            ->whereIsPublished(false)
            ->paginate(request('limit', 20));

        if (request()->all()) {
            $words->appends(request()->all());
        }

        return response()->json($words);
    }
}
