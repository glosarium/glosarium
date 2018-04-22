<?php

namespace App\Http\Controllers\Api\V1\Glosarium;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Glosarium\Word;

class WordController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $words = Word::when($request->keyword, function($query) use($request){
                return $query->where('origin', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('locale', 'LIKE', "%{$request->keyword}%");
            })
            ->sort($request->keyword)
            ->paginate(10);
            
        return response()
            ->json($words);
    }
}
