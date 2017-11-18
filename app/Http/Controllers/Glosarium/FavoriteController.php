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
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use SEO;
use App\Glosarium\Category;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all favorited words by current user.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $favorites = Favorite::whereUserId(Auth::id())
            ->with('word', 'word.category')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $categories = Category::dropdown();

        SEO::setTitle('Kata Favorit');

        return view('glosariums.favorites.index', compact('favorites', 'categories'));
    }
    
    /**
     * Toggle word as favorited by user.
     *
     * @param Word $word
     * @return RedirectResponse
     */
    public function toggle(string $slug): RedirectResponse
    {
        // find word first
        $word = Word::whereSlug($slug)
            ->isPublished()
            ->first();

        abort_if(empty($word), 404, 'Kata tidak ditemukan dalam pangkalan data.');

        $favorite = Favorite::whereUserId(Auth::id())
            ->whereWordId($word->id)
            ->first();

        if (empty($favorite)) {
            $favorite = Favorite::create([
                'user_id' => Auth::id(),
                'word_id' => $word->id,
            ]);
        }
        else {
            $favorite->delete();
        }

        return redirect()->back();
    }    

    /**
     * Delete word word favorite.
     *
     * @param string $id
     * @return RedirectResponse
     */
    function destroy(string $id): RedirectResponse
    {
        $favorite = Favorite::find($id);

        abort_if(empty($favorite), 404, 'Kata tidak ditemukan dalam pangkalan data.');

        $this->authorize('destroy', $favorite);

        $favorite->delete();

        return redirect()
            ->back()
            ->withSuccess('Kata telah dihapus dari daftar favorit.');        
    }

}
