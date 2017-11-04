<?php
namespace App\Wordpress;

class Post extends Wordpress
{
    /**
     * Get all posts from blog.
     *
     * @param bool $embed
     * @return array|null
     */
    public function all(bool $embed = true) : ? array
    {
        $route = '/wp-json/wp/v2/posts?';
        if ($embed) {
            $route .= '_embed';
        }

        $response = $this->client->get($route);

        return $this->parse($response);
    }

    /**
     * Get posts by slug and return single post.
     *
     * @param string $slug
     * @return \stdClass|null
     */
    public function getBySlug(string $slug) : ? \stdClass
    {
        $route = sprintf('wp-json/wp/v2/posts/?_embed&slug=%s', $slug);

        $response = $this->client->get($route);

        $posts = $this->parse($response);
        if (!empty($posts) and !empty($posts[0])) {
            return $posts[0];
        }

        return null;
    }

    /**
     * Search post by title.
     *
     * @param string $query
     * @return \stdClass|null
     */
    public function search(string $query) : ? array
    {
        $route = sprintf('wp-json/wp/v2/posts/?_embed&search=%s', $query);

        $response = $this->client->get($route);
        return $this->parse($response);
    }
}