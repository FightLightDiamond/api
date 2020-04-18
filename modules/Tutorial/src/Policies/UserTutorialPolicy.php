<?php

namespace Tutorial\Policies;

use Tutorial\Models\UserTutorial;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTutorialPolicy
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

    public function view(User $user, UserTutorial $user_tutorials)
    {
        if ($this->permissionRepository->is('view_user_tutorial')) {
            return true;
        }

        return $user->id === $user_tutorials->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_user_tutorial')) {
            return true;
        }

        return false;
    }

    public function update(User $user, UserTutorial $user_tutorials)
    {
        if ($this->permissionRepository->is('update_user_tutorial')) {
            return true;
        }

        return $user->id === $user_tutorials->user_id;
    }

    public function delete($user, UserTutorial $user_tutorials)
    {
        if ($this->permissionRepository->is('delete_user_tutorial')) {
            return true;
        }

        return $user->id === $user_tutorials->user_id;
    }

}
