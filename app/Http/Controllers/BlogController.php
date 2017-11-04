<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use SEO;
use App\Libraries\Wordpress;
use WPBlog;
use WPCategory;
use WPTag;
use WPPost;

class BlogController extends Controller
{
    /**
     * Guzzle client object.
     *
     * @var object
     */
    private $client;

    public function __construct()
    {
        view()->share([
            'info' => WPBlog::info(),
            'categories' => WPCategory::all(),
            'tags' => WPTag::all()
        ]);
    }

    public function index(Request $request)
    {
        $this->validate($request, [
            's' => 'string'
        ]);

        // get posts
        if ($request->has('s')) {
            $posts = WPPost::search($request->s);
        }
        else {
            $posts = WPPost::all();
        }

        return view('blogs.index', compact('categories', 'tags', 'posts'));
    }

    public function show(string $slug)
    {
        $post = WPPost::getBySlug($slug);

        abort_if(empty($post), 404, 'Pos tidak ditemukan.');

        // get image
        $image = collect($post->_embedded->{'wp:featuredmedia'})->first();

        SEO::setTitle($post->title->rendered);
        SEO::setDescription(str_limit(strip_tags(explode('</p>', $post->excerpt->rendered)[0])), 160);
        if (!empty($image)) {
            SEO::opengraph()->addProperty('image', $image->source_url);
        }
        SEO::opengraph()->addProperty('author', $post->_embedded->author[0]->name);

        return view('blogs.show', compact('post', 'image'));
    }
}
