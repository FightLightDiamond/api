<?php

namespace ACL\Policies;

use ACL\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function view(User $user, User $users)
    {
        if ($this->permissionRepository->is('view_user')) {
            return true;
        }

        return $user->id === $users->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_user')) {
            return true;
        }

        return false;
    }

    public function update(User $user, User $users)
    {
        if ($this->permissionRepository->is('update_user')) {
            return true;
        }

        return $user->id === $users->user_id;
    }

    public function delete($user, User $users)
    {
        if ($this->permissionRepository->is('delete_user')) {
            return true;
        }

        return $user->id === $users->user_id;
    }

}
