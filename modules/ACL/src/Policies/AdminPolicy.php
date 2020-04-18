<?php

namespace ACL\Policies;

use ACL\Models\Admin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

    public function view(User $user, Admin $admins)
    {
        if ($this->permissionRepository->is('view_admin')) {
            return true;
        }

        return $user->id === $admins->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_admin')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Admin $admins)
    {
        if ($this->permissionRepository->is('update_admin')) {
            return true;
        }

        return $user->id === $admins->user_id;
    }

    public function delete($user, Admin $admins)
    {
        if ($this->permissionRepository->is('delete_admin')) {
            return true;
        }

        return $user->id === $admins->user_id;
    }

}
