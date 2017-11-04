<?php
namespace App\Dictionary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    /**
     * Set table name.
     *
     * @var string
     */
    protected $table = 'dictionary_groups';

    /**
     * Availabel fields.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Group has many word.
     *
     * @return boolean
     */
    public function words() : HasMany
    {
        return $this->hasMany(Word::class);
    }
}
