<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordDescription;
use App\Glosarium\WordSearch;
use App\Glosarium\WordType;
use App\Http\Requests\Word\ValidationRequest;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class WordController extends Controller
{
    /**
     * Show form and search results if available
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return Response
     */
    public function index()
    {
        if (request('kata')) {
            $words = Word::where('origin', 'LIKE', '%' . request('kata') . '%')
                ->orWhere('glosarium', 'LIKE', '%' . request('kata') . '%')
                ->orderBy('origin', 'ASC')
                ->with('type', 'descriptions')
                ->paginate();

            // log search keyword
            WordSearch::insert([
                'keyword'    => request('kata'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        // count all words
        $wordTotal = Word::count();

        $title = empty(request('kata')) ? trans('word.search') : trans('word.result', ['keyword' => request('kata')]);

        return view('controllers.words.index', compact('words', 'wordTotal'))
            ->withTitle($title);
    }

    /**
     * Show word detail
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param Word $word
     */
    public function word(Word $word)
    {
        return view('controllers.words.word', compact('word'))
            ->withTitle(sprintf('(%s) %s', $word->origin, $word->glosarium));
    }

    /**
     * Show create form
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return Response
     */
    public function create()
    {
        $types = WordType::orderBy('name', 'ASC')
            ->get();

        return view('controllers.words.create', compact('types'))
            ->withTitle(trans('word.create'));
    }

    /**
     * Store new word into database
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param ValidationRequest $request
     */
    public function store(ValidationRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $word = Word::create([
                'slug'      => str_slug($request->glosarium),
                'type_id'   => $request->type,
                'origin'    => $request->origin,
                'glosarium' => $request->glosarium,
                'spell'     => $request->spell,
                'pronounce' => null,
                'status'    => 'published',
            ]);

            if (!empty($request->descriptions)) {
                $now = \Carbon\Carbon::now();

                foreach (explode(PHP_EOL, $request->descriptions) as $description) {
                    $wordDescriptions[] = [
                        'word_id'     => $word->id,
                        'description' => str_replace(PHP_EOL, '', $description),
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ];
                }

                WordDescription::insert($wordDescriptions);
            }
        });

        return redirect()
            ->back()
            ->withSuccess(trans('word.msg.created'));
    }
}
