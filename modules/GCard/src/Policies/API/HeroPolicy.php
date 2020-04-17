<?php

namespace GCard\Policies\API;

use GCard\Models\Hero;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeroPolicy
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

    public function view(User $user, Hero $heroes)
    {
        if ($this->permissionRepository->is('view_hero')) {
            return true;
        }

        return $user->id === $heroes->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_hero')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Hero $heroes)
    {
        if ($this->permissionRepository->is('update_hero')) {
            return true;
        }

        return $user->id === $heroes->user_id;
    }

    public function delete($user, Hero $heroes)
    {
        if ($this->permissionRepository->is('delete_hero')) {
            return true;
        }

        return $user->id === $heroes->user_id;
    }

}
