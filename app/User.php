<?php

namespace App;

use Carbon\Carbon;
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
        'type',
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

    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'created_diff',
        'updated_diff',
        'avatar',
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

    public function getCreatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getUpdatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }

    public function getAvatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->attributes['email']);
    }

    /**
     * @return mixed
     */
    public function glosariums()
    {
        return $this->hasMany(\App\App\Word::class);
    }

    /**
     * @return mixed
     */
    public function glosariumWords()
    {
        return $this->hasMany(\App\App\Word::class);
    }

    /**
     * @return mixed
     */
    public function favorites()
    {
        return $this->hasMany(\App\App\Favorite::class);
    }

    /**
     * @param  $query
     * @return mixed
     */
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
