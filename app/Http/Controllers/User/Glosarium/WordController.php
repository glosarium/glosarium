<?php

namespace App\Http\Controllers\User\Glosarium;

use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function paginate()
    {
        $words = Word::orderBy('origin', 'ASC')
            ->orderBy('locale', 'ASC')
            ->with('category')
            ->filter()
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

    public function show($slug)
    {
        $word = Word::whereSlug($slug)
            ->with('category', 'description')
            ->first();

        return response()->json($word);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|integer|exists:glosarium_categories,id',
            'lang'     => 'required|max:3',
            'origin'   => 'required|max:100|string',
            'locale'   => 'required|max:100|string',
        ]);

        $word = Word::create([
            'category_id'  => $request->category,
            'user_id'      => Auth::id(),
            'lang'         => $request->lang,
            'origin'       => $request->origin,
            'locale'       => $request->locale,
            'is_published' => true,
            'is_standard'  => true,
        ]);

        return response()->json([
            'status' => true,
            'word'   => $word,
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|integer|exists:glosarium_categories,id',
            'slug'     => 'required|string',
            'origin'   => 'required|max:100|string',
            'locale'   => 'required|max:100|string',
        ]);

        $word = Word::whereSlug($request->slug)->first();

        $word->origin = $request->origin;
        $word->locale = $request->locale;
        $word->save();

        return response()->json([
            'status'  => true,
            'message' => trans('glosarium.word.msg.updated', [
                'origin' => $word->origin,
                'locale' => $word->locale,
            ]),
            'word'    => $word,
        ]);
    }
}
