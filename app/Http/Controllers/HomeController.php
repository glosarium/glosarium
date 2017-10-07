<?php

namespace App\Http\Controllers;

use App\Glosarium\Category;
use App\Glosarium\Word;
use App\Libraries\Image;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SEO;

class HomeController extends Controller
{
    /**
     * @param Request $Request
     */
    public function __invoke(Request $request): View
    {
        if ($request->has('word')) {
            $words = Word::sort()
                ->filter($request->word)
                ->isPublished()
                ->paginate();

            $words->appends($request->only('word'));

            if ($words->total() >= 1) {
                $meta = $words->first();
            }

            $title = sprintf('Hasil pencarian kata %s', $request->word);
        }

        $startDay = sprintf('%s 06:00:00', date('Y-m-d'));
        $cacheTime = Carbon::parse($startDay)->addDays(1); // 1 day

        $categories = Cache::remember('category.random', $cacheTime, function () {
            return Category::inRandomOrder()
                ->take(6)
                ->withCount('words')
                ->get();
        });

        // generate header image
        $image = (new Image)->addText(config('app.name'), 50, 400, 200)
            ->render('pages', 'home');

        // seo config
        SEO::setTitle($title ?? config('app.name'));
        SEO::opengraph()->addProperty('image', $image->path());
        if (isset($words) and $words->total() >= 1) {
            if (!empty($words->first()->description['description'])) {
                SEO::setDescription($words->first()->description['description']);
            }
        }

        return view('home', compact('words', 'categories'));
    }
}
