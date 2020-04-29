<?php

namespace English\Policies;

use English\Models\CrazyReadHistory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrazyReadHistoryPolicy
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

    public function view(User $user, CrazyReadHistory $crazy_read_histories)
    {
        if ($this->permissionRepository->is('view_crazy_read_history')) {
            return true;
        }

        return $user->id === $crazy_read_histories->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_crazy_read_history')) {
            return true;
        }

        return false;
    }

    public function update(User $user, CrazyReadHistory $crazy_read_histories)
    {
        if ($this->permissionRepository->is('update_crazy_read_history')) {
            return true;
        }

        return $user->id === $crazy_read_histories->user_id;
    }

    public function delete($user, CrazyReadHistory $crazy_read_histories)
    {
        if ($this->permissionRepository->is('delete_crazy_read_history')) {
            return true;
        }

        return $user->id === $crazy_read_histories->user_id;
    }

}
