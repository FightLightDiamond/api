<?php

namespace English\Policies;

use English\Models\CrazyListenHistory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrazyListenHistoryPolicy
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

    public function view(User $user, CrazyListenHistory $crazy_listen_histories)
    {
        if ($this->permissionRepository->is('view_crazy_listen_history')) {
            return true;
        }

        return $user->id === $crazy_listen_histories->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_crazy_listen_history')) {
            return true;
        }

        return false;
    }

    public function update(User $user, CrazyListenHistory $crazy_listen_histories)
    {
        if ($this->permissionRepository->is('update_crazy_listen_history')) {
            return true;
        }

        return $user->id === $crazy_listen_histories->user_id;
    }

    public function delete($user, CrazyListenHistory $crazy_listen_histories)
    {
        if ($this->permissionRepository->is('delete_crazy_listen_history')) {
            return true;
        }

        return $user->id === $crazy_listen_histories->user_id;
    }

}
