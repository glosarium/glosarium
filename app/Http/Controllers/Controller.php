<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Generate image header for every need.
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     *
     * @param string $text  image label
     * @param string $paths base path for image
     * @param int    $size  default font size
     */
    protected function createImage(string $text, string $path, string $file, $size = 50): string
    {
        // list of flat colors
        $colors = collect([
            '#1abc9c',
            '#2ecc71',
            '#3498db',
            '#9b59b6',
            '#34495e',
            '#16a085',
            '#27ae60',
            '#2980b9',
            '#8e44ad',
            '#2c3e50',
            '#f1c40f',
            '#e67e22',
            '#e74c3c',
            '#95a5a6',
            '#f39c12',
            '#d35400',
            '#c0392b',
        ]);

        $path = str_finish($path, '/');

        if (!\File::exists(public_path($path.$file))) {
            $canvas = \Image::canvas(800, 400, $colors->random());

            $canvas->text($text, 400, 200, function ($font) use ($size) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size($size);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true);
            }

            $canvas->save(public_path($path.$file));
        }

        return $path.$file;
    }
}
