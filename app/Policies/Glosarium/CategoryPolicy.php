<?php

namespace App\Policies\Glosarium;

use App\Glosarium\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->type == 'admin';
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\User               $user
     * @param  \App\Glosarium\Category $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\User               $user
     * @param  \App\Glosarium\Category $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\User               $user
     * @param  \App\Glosarium\Category $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        //
    }
}
