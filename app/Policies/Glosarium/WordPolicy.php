<?php

namespace App\Policies\Glosarium;

use App\Glosarium\Word;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return mixed
     */
    public function before(User $user)
    {
        return $user->type == 'admin';
    }

    /**
     * @param User $user
     * @param Word $word
     */
    public function moderation(User $user, Word $word)
    {
        # code...
    }

    /**
     * Determine whether the user can view the word.
     *
     * @param  \App\User     $user
     * @param  \App\App\Word $word
     * @return mixed
     */
    public function view(User $user, Word $word)
    {

    }

    /**
     * Determine whether the user can create words.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the word.
     *
     * @param  \App\User     $user
     * @param  \App\App\Word $word
     * @return mixed
     */
    public function update(User $user, Word $word)
    {
        //
    }

    /**
     * Determine whether the user can delete the word.
     *
     * @param  \App\User     $user
     * @param  \App\App\Word $word
     * @return mixed
     */
    public function delete(User $user, Word $word)
    {
        //
    }
}
