<?php

namespace App\Http\Controllers\User\Glosarium;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Glosarium\Word;
use SEO;

class WordController extends Controller
{
    /**
     * Show all glossary words.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        SEO::setTitle('Kata dalam Glosarium');

        $words = Word::orderBy('origin', 'ASC')
            ->with('user', 'category')
            ->paginate();

        return view('users.glosariums.words.index', compact('words'));
    }
}
