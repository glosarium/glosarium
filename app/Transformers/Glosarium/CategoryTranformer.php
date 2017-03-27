<?php

namespace App\Transformers\Glosarium;

use App\Glosarium\Category;
use League\Fractal\TransformerAbstract;

class CategoryTranformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'slug'        => $category->slug,
            'name'        => $category->name,
            'url'         => route('glosarium.category.show', [$category->slug]),
            'totalWord'   => $category->words_count,
            'isPublished' => $category->is_published,
            'createdAt'   => $category->created_at->toIso8601String(),
            'updatedAt'   => $category->updated_at->toIso8601String(),
        ];
    }
}
