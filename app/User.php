<?php
namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'image',
        'type',
        'about',
        'headline',
        'website',
        'twitter',
        'instagram',
        'facebook',
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
        'avatar',
        'twitter_link',
        'instagram_link',
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

    /**
     * Get image path from Gravatar based on email address.
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        if (!empty($this->attributes['image'])) {
            return $this->attributes['image'];
        }
        return 'https://www.gravatar.com/avatar/' . md5($this->attributes['email']) . '?s=200';
    }

    /**
     * Return full path Twitter profile.
     *
     * @return string|null
     */
    public function getTwitterLinkAttribute(): ?string
    {
        if (!empty($this->attributes['twitter'])) {
            return 'https://www.twitter.com/' . $this->attributes['twitter'];
        }

        return null;
    }

    /**
     * Get full path Instagram profile.
     *
     * @return string|null
     */
    public function getInstagramLinkAttribute(): ?string
    {
        if (!empty($this->attributes['instagram'])) {
            return 'https://www.instagram.com/' . $this->attributes['instagram'];
        }

        return null;
    }

    /**
     * User has many words.
     *
     * @return void
     */
    public function words()
    {
        return $this->hasMany(\App\Glosarium\Word::class);
    }

    /**
     * @return mixed
     */
    public function favorites()
    {
        return $this->hasMany(\App\App\Favorite::class);
    }

    /**
     * User has many providers (social media account).
     *
     * @return HasMany
     */
    public function providers(): HasMany
    {
        return $this->hasMany(UserProvider::class);
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
