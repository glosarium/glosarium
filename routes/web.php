<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'HomeController')->name('home');

// contact controller
Route::get('kontak', 'ContactController@form')->name('contact.form');
Route::get('kontak/pesan/{id}', 'ContactController@show')->name('contact.show');
Route::post('kontak/kirim', 'ContactController@send')->name('contact.post');

// static pages
Route::get('tentang-kami', 'PageController@about')->name('page.about');

Route::get('test-url', function () {
    $client = new \GuzzleHttp\Client([
        'base_uri' => config('services.google_url_shortener.url')
    ]);

    $word = App\Glosarium\Word::inRandomOrder()->first();

    $response = $client->post('v1/url', [
        'headers' => [
            'Content-Type' => 'application/json'
        ],
        'query' => [
            'key' => config('services.google_url_shortener.key')
        ],
        'json' => [
            'longUrl' => sprintf('https://www.glosarium.web.id/%s/%s', 
                $word->category->slug,
                $word->slug
            )
        ]
    ]);

    if ($response->getStatusCode() === 200) {
        $body = json_decode((string)$response->getBody());

        if (!empty($body->id)) {
            $word->short_url = $body->id;
            $word->save();
        }

        return response()->json($word);
    }
});