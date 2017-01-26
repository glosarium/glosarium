<?php

namespace App\Transformers\Dictionary;

use Themsaid\Transformers\AbstractTransformer;

/**
 *
 */
class WordTransformer extends AbstractTransformer
{
    public function transformModel()
    {
        return [
            'word',
            'slug',
            'updated_diff',
        ];
    }
}
