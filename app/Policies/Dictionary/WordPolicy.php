<?php

namespace App\Policies\Dictionary;

use App\User;
use App\Dictionary\Word;
use Illuminate\Auth\Access\HandlesAuthorization;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the word.
     *
     * @param  \App\User  $user
     * @param  \App\Dictionary\Word  $word
     * @return mixed
     */
    public function view(User $user, Word $word)
    {
        //
    }

    /**
     * Determine whether the user can create words.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the word.
     *
     * @param  \App\User  $user
     * @param  \App\Dictionary\Word  $word
     * @return mixed
     */
    public function update(User $user, Word $word)
    {
        //
    }

    /**
     * Determine whether the user can destroy the word.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function destroy(User $user, Word $word): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Determine whether the user can delete the word.
     *
     * @param  \App\User  $user
     * @param  \App\Dictionary\Word  $word
     * @return mixed
     */
    public function delete(User $user, Word $word)
    {
        //
    }
}
