<?php

namespace English\Policies;

use English\Models\Crazy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrazyPolicy
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

    public function view(User $user, Crazy $crazies)
    {
        if ($this->permissionRepository->is('view_crazy')) {
            return true;
        }

        return $user->id === $crazies->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_crazy')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Crazy $crazies)
    {
        if ($this->permissionRepository->is('update_crazy')) {
            return true;
        }

        return $user->id === $crazies->user_id;
    }

    public function delete($user, Crazy $crazies)
    {
        if ($this->permissionRepository->is('delete_crazy')) {
            return true;
        }

        return $user->id === $crazies->user_id;
    }

}
