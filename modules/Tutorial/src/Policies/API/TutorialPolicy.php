<?php

namespace Tutorial\Policies;

use Tutorial\Models\Tutorial;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TutorialPolicy
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

    public function view(User $user, Tutorial $tutorials)
    {
        if ($this->permissionRepository->is('view_tutorial')) {
            return true;
        }

        return $user->id === $tutorials->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_tutorial')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Tutorial $tutorials)
    {
        if ($this->permissionRepository->is('update_tutorial')) {
            return true;
        }

        return $user->id === $tutorials->user_id;
    }

    public function delete($user, Tutorial $tutorials)
    {
        if ($this->permissionRepository->is('delete_tutorial')) {
            return true;
        }

        return $user->id === $tutorials->user_id;
    }

}
