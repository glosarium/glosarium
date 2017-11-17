<?php

namespace App\Http\Controllers\Dictionary;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dictionary\Word;
use Illuminate\View\View;
use SEO;
use Log;
use Illuminate\Http\RedirectResponse;

class WordController extends Controller
{
    /**
     * Show all registered dictionary words.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEO::setTitle('Kamus');
        
        $words = Word::orderBy('word', 'ASC')
            ->with('group', 'user')
            ->whereLang('id')
            ->paginate($request->limit ?? 20);

        return view('dictionaries.words.index', compact('words'));
    }

    /**
     * Show dictionary word detail.
     *
     * @param string $word
     * @return View
     */
    public function show(string $entry): View
    {
        $word = Word::whereWord($entry)
            ->with('group', 'user', 'descriptions')
            ->first();

        if (empty($word)) {
            Log::warning($exception = sprintf('Kata "%s" tidak ditemukan dalam pangkalan data.', $entry));
            abort(404, $exception);
        }

        SEO::setTitle(sprintf('Arti kata %s dalam kamus bahasa Indonesia', $word->word));
        if (! empty($word->descriptions)) {
            SEO::setDescription($word->descriptions->first()->text);
        }

        return view('dictionaries.words.show', compact('word'));
    }

    /**
     * Move word to trash bin (soft deletes).
     *
     * @param string $entry
     * @return RedirectResponse
     */
    public function destroy(string $entry): RedirectResponse
    {
        $word = Word::whereWord($entry)->firstOrFail();

        $this->authorize('destroy', $word);

        $word->delete();

        return redirect()
            ->back()
            ->withSuccess('Kata dalam pangkalan data kamus berhasil dihapus.');
    }
}
