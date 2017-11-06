<?php

namespace App\Policies\Glosarium;

use App\Glosarium\Word;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * Show all glosarium words.
     *
     * @param User $user
     * @return void
     */
    public function all(User $user): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Show pending words.
     *
     * @param User $user
     * @return bool
     */
    public function moderation(User $user): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Determine whether the user can view the word.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function view(User $user, Word $word): bool
    {
        return $user->type === 'admin' or $user->id == $word->user_id;
    }

    /**
     * Determine whether the user can create words.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the word.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function update(User $user, Word $word): bool
    {
        return $user->type === 'admin' or $user->id == $word->user_id;
    }

    /**
     * Determine whether the user can delete the word.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function destroy(User $user, Word $word): bool
    {
        return $user->type === 'admin' or $user->id == $word->user_id;
    }

    /**
     * Authorize publish word.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function publish(User $user, Word $word): bool
    {
        return $user->type === 'admin';
    }
    
    /**
     * Word has been moved to trash.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function trash(User $user): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Restore trashed word.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function restore(User $user, Word $word): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Delete word forever.
     *
     * @param User $user
     * @param Word $word
     * @return bool
     */
    public function delete(User $user, Word $word): bool
    {
        return $user->type === 'admin';
    }
}
