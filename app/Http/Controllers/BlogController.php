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
use Illuminate\View\View;

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

    /**
     * Show all blog posts.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
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
        
        // generate SEO metadata based on latest post
        if (! empty($posts) and ! empty($posts[0])) {
            $post = $posts[0];
            SEO::setTitle($post->title->rendered);
            SEO::setDescription(str_limit(strip_tags($post->excerpt->rendered), 160));

            if (isset($post->_embedded->{'wp:featuredmedia'})) {
                $media = $media = collect($post->_embedded->{'wp:featuredmedia'})->first();
                SEO::opengraph()->addProperty('image', $media->media_details->sizes->full->source_url);
            }
        }

        return view('blogs.index', compact('categories', 'tags', 'posts'));
    }

    /**
     * Show single post using slug.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $post = WPPost::getBySlug($slug);

        abort_if(empty($post), 404, 'Pos tidak ditemukan dalam pangkalan data.');

        SEO::setTitle($post->title->rendered);
        SEO::setDescription(str_limit(strip_tags(explode('</p>', $post->excerpt->rendered)[0])), 160);
        if (isset($post->_embedded->{'wp:featuredmedia'})) {
            // get image
            $image = collect($post->_embedded->{'wp:featuredmedia'})->first();
            SEO::opengraph()->addProperty('image', $image->source_url);
        }
        SEO::opengraph()->addProperty('author', $post->_embedded->author[0]->name);

        return view('blogs.show', compact('post', 'image'));
    }
}
