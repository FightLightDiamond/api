<?php

namespace English\Policies;

use English\Models\Remind;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RemindPolicy
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

    public function view(User $user, Remind $reminds)
    {
        if ($this->permissionRepository->is('view_remind')) {
            return true;
        }

        return $user->id === $reminds->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_remind')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Remind $reminds)
    {
        if ($this->permissionRepository->is('update_remind')) {
            return true;
        }

        return $user->id === $reminds->user_id;
    }

    public function delete($user, Remind $reminds)
    {
        if ($this->permissionRepository->is('delete_remind')) {
            return true;
        }

        return $user->id === $reminds->user_id;
    }

}
