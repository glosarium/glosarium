<?php

namespace App\Http\Controllers\User\Glosarium;

use App\Glosarium\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Glosarium\CategoryRequest;
use Schema;

class CategoryController extends Controller
{
    public function updateField(CategoryRequest $request)
    {

        if (!Schema::hasColumn((new Category)->getTable(), request('field'))) {
            return [
                'isSuccess' => false,
                'message'   => 'Kolom tidak ditemukan.',
            ];
        }

        // check column is exists
        $category = Category::find(request('id'));
        if (empty($category)) {
            return [
                'isSuccess' => false,
                'message'   => 'Kategori tidak ditemukan.',
            ];
        }

        try {

            $field            = request('field');
            $category->$field = request('text');
            $category->save();

            return [
                'isSuccess' => true,
                'message'   => 'Deskripsi kategori berhasil diperbarui.',
            ];

        } catch (Exception $e) {
            return [
                'isSuccess' => false,
                'message'   => $e->getMessage(),
            ];
        }
    }
}
