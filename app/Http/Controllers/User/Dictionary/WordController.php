<?php

namespace App\Http\Controllers\User\Dictionary;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dictionary\Word;
use Illuminate\View\View;

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
        $words = Word::orderBy('word', 'ASC')
            ->with('group', 'user')
            ->paginate($request->limit ?? 20);

        return view('users.dictionaries.words.index', compact('words'));
    }
}
