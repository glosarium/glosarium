<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{
    protected $fillable = [
        'user_id',
        'driver_name',
        'driver_id',
        'name',
        'email',
        'image',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * Casts default driver id as sha1 instead of plain text from social media.
     *
     * @param string $id
     * @return string
     */
    public function setDriverIdAttribute(string $id): string
    {
        return sha1($id);
    }

    /**
     * User providers belongs to user.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Register new provider to user.
     *
     * @param object $provider
     * @param User $user
     * @param string $driver
     * @return self
     */
    public static function store($provider, User $user, string $driver): self
    {
        return self::create([
            'user_id' => $user->id,
            'driver_id' => $provider->getId(),
            'driver_name' => $driver,
            'name' => $provider->getName(),
            'nickname' => $provider->getNickname(),
            'email' => $provider->getEmail(),
            'image' => !empty($provider->avatar_original) ? $provider->avatar_original : $provider->getAvatar(),
        ]);
    }
}
