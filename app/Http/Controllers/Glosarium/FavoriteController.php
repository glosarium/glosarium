<?php
/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Favorite;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     */
    public function favorite(Request $request)
    {
        $word = Word::whereSlug(request('slug'))->first();
        if (empty($word)) {
            return response()->json([
                'success' => false,
                'message' => trans('glosarium.word.notFound'),
            ]);
        }

        $favorite = Favorite::whereUserId(Auth::id())
            ->whereWordId($word->id)
            ->first();

        if (empty($favorite)) {
            $favorite = Favorite::create([
                'user_id' => Auth::id(),
                'word_id' => $word->id,
            ]);

            return response()->json([
                'success' => true,
                'favorite' => $favorite,
            ]);
        }

        return response()->json([
            'success' => false,
            'favorite' => $favorite,
        ]);
    }
}
