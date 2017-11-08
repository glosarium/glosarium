<?php

namespace App\Policies;

use App\User;
use App\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view all message.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Determine whether the user can view the message.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function view(User $user, Message $message): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Determine whether the user can create messages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the message.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function update(User $user, Message $message)
    {
        //
    }

    /**
     * Determine whether the user can destroy the message.
     *
     * @param User $user
     * @param Message $message
     * @return bool
     */
    public function destroy(User $user, Message $message): bool
    {
        return $user->type === 'admin';
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function delete(User $user, Message $message)
    {
        //
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param User $user
     * @param Message $message
     * @return bool
     */
    public function reply(User $user, Message $message): bool
    {
        return $user->type === 'admin';
    }
}
