<?php
namespace App\Dictionary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Description extends Model
{
    use SoftDeletes;

    /**
     * Set table name.
     *
     * @var string
     */
    protected $table = 'dictionary_descriptions';

    /**
     * Available fields.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'sample',
        'source'
    ];

    /**
     * Casts into Carbon object.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Description belongs to word.
     *
     * @return void
     */
    public function word() : BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
