<?php

namespace App\Policies\Glosarium;

use App\User;
use App\Glosarium\Favorite;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the favorite.
     *
     * @param  \App\User  $user
     * @param  \App\Glosarium\Favorite  $favorite
     * @return mixed
     */
    public function view(User $user, Favorite $favorite)
    {
        //
    }

    /**
     * Determine whether the user can create favorites.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the favorite.
     *
     * @param  \App\User  $user
     * @param  \App\Glosarium\Favorite  $favorite
     * @return mixed
     */
    public function update(User $user, Favorite $favorite)
    {
        //
    }

    /**
     * Determine whether the user can destroy the favorite.
     *
     * @param User $user
     * @param Favorite $favorite
     * @return bool
     */
    public function destroy(User $user, Favorite $favorite): bool
    {
        return $user->id === $favorite->user_id;
    }

    /**
     * Determine whether the user can delete the favorite.
     *
     * @param  \App\User  $user
     * @param  \App\Glosarium\Favorite  $favorite
     * @return mixed
     */
    public function delete(User $user, Favorite $favorite)
    {
        //
    }
}
