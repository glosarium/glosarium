<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Glosarium;

use App\Dictionary\Word as WordDictionary;
use App\Glosarium\Category;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glosarium\WordRequest;
use App\Mail\Glosarium\CreateMail;
use Auth;
use Cache;
use Carbon\Carbon;
use Mail;

/**
 * Manage glosarium words
 */
class WordController extends Controller
{

    /**
     * Show all words
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        if (request('category')) {
            $category = Category::whereSlug(trim(request('category')))->first();

            abort_if(empty($category), 404, sprintf('Kategori "%s" tidak ditemukan.', title_case(request('category'))));
        }

        $totalWord = Cache::get('glosarium.total', function () {
            return Word::whereIsPublished(true)->count();
        });

        $words = Word::orderBy('locale')
            ->with('category')
            ->whereIsPublished(true)
            ->filter()
            ->paginate(config('glosarium.limit', 20));

        $categories = Cache::remember('category', Carbon::now()->addDays(30), function () {
            return Category::select('name', 'slug')
                ->orderBy('name', 'ASC')
                ->withCount('words')
                ->get();
        });

        return view('glosariums.words.index', compact('totalWord', 'words', 'categories', 'category'))
            ->withTitle('Indeks Glosarium');
    }

    public function show($category, $slug)
    {
        $totalWord = Word::whereIsPublished(true)->count();

        $word = Word::whereSlug($slug)
            ->with('category', 'descriptions', 'user')
            ->firstOrFail();

        // save to dictionary
        $locales = array_map(function ($word) {
            return trim(strtolower($word));
        }, preg_split("/[\s,\/;\(\)]+/", $word->locale));

        // find similar category
        $categories = Category::orderBy('name', 'ASC')
            ->whereHas('words', function ($query) use ($word) {
                return $query->whereOrigin($word->origin);
            })
            ->with('words')
            ->get();

        // find word by word
        $dictionaries = WordDictionary::whereIn('word', array_filter($locales))
            ->orderBy('word', 'ASC')
            ->with('descriptions', 'descriptions.type')
            ->get();

        return view('glosariums.words.show', compact('totalWord', 'word', 'dictionaries', 'categories'))
            ->withTitle(sprintf('%s - %s', $word->origin, $word->locale));
    }

    public function total()
    {
        abort_if(!request()->ajax(), 404, 'Halaman tidak ditemukan.');

        $cacheTime = \Carbon\Carbon::now()->addDays(7);
        $total     = Cache::remember('glosarium.total', $cacheTime, function () {
            return \App\Glosarium\Word::count();
        });

        return response()->json([
            'isSuccess' => true,
            'total'     => number_format($total, 0, ',', '.'),
        ]);
    }

    public function create()
    {
        return view('glosariums.words.create')
            ->withTitle(trans('glosarium.create'));
    }

    public function store(WordRequest $request)
    {
        try {
            $glosarium = Word::create([
                'user_id'      => Auth::id(),
                'category_id'  => $request->category,
                'origin'       => $request->origin,
                'locale'       => $request->locale,
                'lang'         => 'en',
                'is_published' => false,
                'is_standard'  => false,
                'retry_count'  => 0,
            ]);

            // send email proposal
            Mail::to(config('mail.from.address'))->send(new CreateMail($glosarium));

        } catch (Exception $e) {
            return response()->json([
                'isSuccess' => false,
                'message'   => $e->getMessage(),
            ]);
        }

        return response()->json([
            'isSuccess' => true,
            'glosarium' => $glosarium,
            'alerts'    => [
                'type'    => 'success',
                'title'   => trans('glosarium.success'),
                'message' => trans('glosarium.msg.created'),
            ],
        ]);
    }
}
