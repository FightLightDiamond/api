<?php

namespace English\Policies;

use English\Models\Blog;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    private $roleRepository, $permissionRepository;


    public function before($user, $ability)
    {
        // do something
    }

    public function view(User $user, Blog $blogs)
    {
        if ($this->permissionRepository->is('view_blog')) {
            return true;
        }

        return $user->id === $blogs->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_blog')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Blog $blogs)
    {
        if ($this->permissionRepository->is('update_blog')) {
            return true;
        }

        return $user->id === $blogs->user_id;
    }

    public function delete($user, Blog $blogs)
    {
        if ($this->permissionRepository->is('delete_blog')) {
            return true;
        }

        return $user->id === $blogs->user_id;
    }

}
