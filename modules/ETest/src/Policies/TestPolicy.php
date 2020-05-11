<?php

namespace ETest\Policies;

use ETest\Models\Test;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
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

    public function view(User $user, Test $tests)
    {
        if ($this->permissionRepository->is('view_test')) {
            return true;
        }

        return $user->id === $tests->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_test')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Test $tests)
    {
        if ($this->permissionRepository->is('update_test')) {
            return true;
        }

        return $user->id === $tests->user_id;
    }

    public function delete($user, Test $tests)
    {
        if ($this->permissionRepository->is('delete_test')) {
            return true;
        }

        return $user->id === $tests->user_id;
    }

}
