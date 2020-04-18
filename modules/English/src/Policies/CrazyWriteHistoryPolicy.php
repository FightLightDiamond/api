<?php

namespace English\Policies;

use English\Models\CrazyWriteHistory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrazyWriteHistoryPolicy
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

    public function view(User $user, CrazyWriteHistory $crazy_write_histories)
    {
        if ($this->permissionRepository->is('view_crazy_write_history')) {
            return true;
        }

        return $user->id === $crazy_write_histories->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_crazy_write_history')) {
            return true;
        }

        return false;
    }

    public function update(User $user, CrazyWriteHistory $crazy_write_histories)
    {
        if ($this->permissionRepository->is('update_crazy_write_history')) {
            return true;
        }

        return $user->id === $crazy_write_histories->user_id;
    }

    public function delete($user, CrazyWriteHistory $crazy_write_histories)
    {
        if ($this->permissionRepository->is('delete_crazy_write_history')) {
            return true;
        }

        return $user->id === $crazy_write_histories->user_id;
    }

}
