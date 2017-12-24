<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{
    protected $fillable = [
        'user_id',
        'driver_name',
        'driver_id',
        'name',
        'nickname',
        'email',
        'image',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * User providers belongs to user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Register new provider to user.
     *
     * @param object $provider
     * @param User   $user
     * @param string $driver
     *
     * @return self
     */
    public static function store($provider, User $user, string $driver): self
    {
        $image = !empty($provider->avatar_original) ? $provider->avatar_original : $provider->getAvatar();

        return self::create([
            'user_id' => $user->id,
            'driver_id' => sha1($provider->getId()),
            'driver_name' => $driver,
            'name' => $provider->getName(),
            'nickname' => $provider->getNickname(),
            'email' => $provider->getEmail(),
            'image' => str_replace('http:', 'https:', $image),
        ]);
    }
}
