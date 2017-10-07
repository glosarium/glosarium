<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Libraries;

use File;
use Illuminate\Support\Facades\Storage;
use Image as Intervention;

/**
 * Image creator
 */
class Image
{
    /**
     * Image width
     *
     * @var integer
     */
    private $width = 800;

    /**
     * Image height
     *
     * @var integer
     */
    private $height = 400;

    /**
     * Canvas color
     *
     * @var array
     */
    private $bgColor = [
        '#16a085',
        '#27ae60',
        '#2980b9',
        '#8e44ad',
        '#2c3e50',
        '#f39c12',
        '#d35400',
        '#c0392b',
        '#7f8c8d',
    ];

    /**
     * Texts will be placed to canvas
     *
     * @var array
     */
    private $texts = [];

    /**
     * Full path of mage
     *
     * @var string
     */
    private $path;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Add new text to canvas
     *
     * @param string  $text
     * @param integer $size
     * @param integer $x
     * @param integer $y
     * @param string  $color
     */
    public function addText($text, $size, $x, $y, $color = '#ffffff'): self
    {
        $this->texts[] = [
            'text' => $text,
            'size' => $size,
            'x' => (int) $x,
            'y' => (int) $y,
            'color' => $color,
        ];

        return $this;
    }

    /**
     * Create new image
     *
     * @param  string $path
     * @param  string $name
     * @return void
     */
    public function render($path, $name): self
    {
        if (!ends_with($path, '/')) {
            $path .= '/';
        }

        $file = sprintf('%s.jpg', str_slug($name));

        if (!Storage::disk('local')->exists($path . $file)) {
            $canvas = Intervention::canvas($this->width, $this->height, collect($this->bgColor)->random());

            if (empty($this->texts)) {
                abort(500, 'Text is empty.');
            }

            foreach ($this->texts as $text) {
                $canvas->text($text['text'], $text['x'], $text['y'], function ($font) use ($text) {
                    $font->file(storage_path('font/Monaco.ttf'));
                    $font->size($text['size']);
                    $font->color($text['color']);
                    $font->align('center');
                    $font->valign('center');
                });
            }

            try {
                Storage::put($path . $file, $canvas->encode('jpg'));

            } catch (Exception $e) {
                abort(500, $e->getMessage());
            }
        }

        $this->path = url(Storage::url($path . $file));

        return $this;
    }

    /**
     * Get absolute path of image
     *
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }
}
