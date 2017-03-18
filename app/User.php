<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_active',
    ];

    /**
     * Convert to Carbon object
     *
     * @var var
     */
    protected $dates = [
        'deleted_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
            ],
        ];
    }

    public function glosariums()
    {
        return $this->hasMany(\App\Glosarium\Word::class);
    }

    public function scopeFilter($query)
    {
        $keyword = request('keyword');

        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%');
        }

        return $query;
    }
}
