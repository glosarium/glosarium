<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordDescription;
use App\Glosarium\WordType;
use App\Http\Requests\Word\ValidationRequest;

class WordController extends Controller
{
    public function index()
    {
        if (request('kata')) {
            $words = Word::where('origin', 'LIKE', '%' . request('kata') . '%')
                ->orderBy('origin', 'ASC')
                ->with('type', 'descriptions')
                ->paginate();
        }

        $title = empty(request('kata')) ? trans('word.search') : trans('word.result', ['keyword' => request('kata')]);

        return view('controllers.words.index', compact('words'))
            ->withTitle($title);
    }

    /**
     * @param Word $word
     */
    public function word(Word $word)
    {
        return view('controllers.words.word', compact('word'))
            ->withTitle($word->glosarium);
    }

    public function create()
    {
        $types = WordType::orderBy('name', 'ASC')
            ->get();

        return view('controllers.words.create', compact('types'))
            ->withTitle(trans('word.create'));
    }

    /**
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
