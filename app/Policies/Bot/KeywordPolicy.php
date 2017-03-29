<?php

namespace App\Policies\Bot;

use App\Bot\Keyword;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeywordPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->type == 'admin';
    }

    /**
     * Determine whether the user can view the keyword.
     *
     * @param  \App\User        $user
     * @param  \App\Bot\Keyword $keyword
     * @return mixed
     */
    public function view(User $user, Keyword $keyword)
    {
        //
    }

    /**
     * Determine whether the user can create keywords.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the keyword.
     *
     * @param  \App\User        $user
     * @param  \App\Bot\Keyword $keyword
     * @return mixed
     */
    public function update(User $user, Keyword $keyword)
    {
        //
    }

    /**
     * Determine whether the user can delete the keyword.
     *
     * @param  \App\User        $user
     * @param  \App\Bot\Keyword $keyword
     * @return mixed
     */
    public function delete(User $user, Keyword $keyword)
    {
        //
    }
}
