<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Glosarium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Glosarium\Description;

class DescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Vote description.
     *
     * @param Request $request
     * @param string $slug
     * @param string $type
     * @return RedirectResponse
     */
    public function vote(Request $request, string $slug, string $type = 'bagus'): RedirectResponse
    {
        abort_if(! in_array($type, ['bagus', 'jelek']), 500, 'Aksi tidak diziinkan.');

        $description = Description::whereHas('word', function($word) use($slug){
                return $word->whereSlug($slug);
            })
            ->first();

        abort_if(empty($description), 404, 'Deskripsi tidak ditemukan dalam pangkalan data.');

        if ($type == 'bagus') {
            $description->vote_up += 1;
        }
        else {
            $description->vote_down -= 1;
        }

        $description->save();

        return redirect()->back();
    }

    public function up(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:glosarium_descriptions,id',
        ]);

        $description = Description::find(request('id'));

        $description->increment('vote_up', 1);
        $description->save();

        return response()->json($description);
    }

    public function down(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:glosarium_descriptions,id',
        ]);

        $description = Description::find(request('id'));

        $description->increment('vote_down', 1);
        $description->save();

        return response()->json($description);
    }
}
