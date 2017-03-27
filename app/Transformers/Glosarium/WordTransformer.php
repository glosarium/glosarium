<?php

namespace App\Transformers\Glosarium;

use App\Glosarium\Word;
use League\Fractal\TransformerAbstract;

class WordTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Word $word)
    {
        if (!empty($word->description)) {
            $description = [
                'description' => $word->description->description,
                'url'         => $word->description->url,
            ];
        } else {
            $description = null;
        }

        return [
            'slug'        => $word->slug,
            'lang'        => $word->lang,
            'origin'      => $word->origin,
            'locale'      => $word->locale,
            'url'         => route('glosarium.word.show', [$word->category->slug, $word->slug]),
            'shortUrl'    => $word->short_url,
            'isPublished' => $word->is_published,
            'createdAt'   => $word->created_at->toIso8601String(),
            'updatedAt'   => $word->updated_at->toIso8601String(),
            'category'    => [
                'slug'        => $word->category->slug,
                'name'        => $word->category->name,
                'description' => $word->category->description,
                'url'         => route('glosarium.category.show', [$word->category->slug]),
                'createdAt'   => $word->category->created_at->toIso8601String(),
                'updatedAt'   => $word->category->updated_at->toIso8601String(),
            ],
            'description' => $description,
        ];
    }
}
