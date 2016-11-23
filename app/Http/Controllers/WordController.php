<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;
use App\Glosarium\WordDescription;
use App\Glosarium\WordSearch;
use App\Http\Requests\Word\ValidationRequest;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class WordController extends Controller
{
    /**
     * @var collection
     */
    protected $colors;

    public function __construct()
    {
        $this->colors = collect([
            '#1abc9c',
            '#2ecc71',
            '#3498db',
            '#9b59b6',
            '#34495e',
            '#16a085',
            '#27ae60',
            '#2980b9',
            '#8e44ad',
            '#2c3e50',
            '#f1c40f',
            '#e67e22',
            '#e74c3c',
            '#95a5a6',
            '#f39c12',
            '#d35400',
            '#c0392b',
        ]);
    }

    /**
     * Show form and search results if available
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return Response
     */
    public function index()
    {
        if (request('kata')) {
            $words = Word::where('foreign', 'LIKE', '%' . request('kata') . '%')
                ->orWhere('locale', 'LIKE', '%' . request('kata') . '%')
                ->orderBy('locale', 'ASC')
                ->with('category', 'descriptions.type')
                ->paginate();

            // log search keyword
            if (strlen(request('kata')) >= 3) {
                WordSearch::insert([
                    'keyword'    => request('kata'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        // count all words
        $wordTotal = Word::count();

        $title = empty(request('kata')) ? config('app.name') : trans('word.result', ['keyword' => request('kata')]);

        return view('controllers.words.index', compact('words', 'wordTotal'))
            ->withTitle($title);
    }

    /**
     * Show word detail
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param Word $word
     */
    public function word(WordCategory $category, Word $word)
    {
        $path = sprintf(
            'image/%s/%s/',
            substr($word->slug, 0, 1),
            $word->category->slug
        );
        $file = sprintf('%s.jpg', $word->slug);

        if (!\File::exists(public_path($path . $file))) {
            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true);
            }
            $canvas = \Image::canvas(800, 400, $this->colors->random());

            $canvas->text($word->locale, 400, 200, function ($font) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size(50);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            $canvas->text('(' . $word->foreign . ')', 400, 250, function ($font) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size(30);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            $canvas->save(public_path($path . $file));
        }

        return view('controllers.words.word', compact('word', 'path', 'file'))
            ->withTitle(sprintf('(%s) %s', $word->foreign, $word->locale));
    }

    /**
     * Show create form
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return Response
     */
    public function create()
    {
        $categories = WordCategory::orderBy('name', 'ASC')
            ->get();

        return view('controllers.words.create', compact('categories'))
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
                'slug'        => str_slug($request->locale),
                'category_id' => 1,
                'lang'        => 'en',
                'type_id'     => $request->type,
                'foreign'     => $request->origin,
                'locale'      => $request->glosarium,
                'spell'       => $request->spell,
                'status'      => 'published',
            ]);

            if (!empty($request->descriptions)) {
                $now = \Carbon\Carbon::now();

                foreach (explode(PHP_EOL, $request->descriptions) as $description) {
                    $wordDescriptions[] = [
                        'word_id'     => $word->id,
                        'type_id'     => 2,
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

    public function api()
    {
        $path = 'image/';
        $file = 'api.jpg';

        if (!\File::exists(public_path($path . $file))) {
            $canvas = \Image::canvas(800, 400, '#e74c3c');

            $canvas->text(trans('word.apa'), 400, 200, function ($font) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size(30);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true);
            }

            $canvas->save(public_path($path . $file));
        }

        return view('controllers.words.api', compact('path', 'file'))
            ->withTitle(trans('word.apa'));
    }
}
