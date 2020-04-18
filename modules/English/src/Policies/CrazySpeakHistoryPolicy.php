<?php

namespace English\Policies;

use English\Models\CrazySpeakHistory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrazySpeakHistoryPolicy
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

    public function view(User $user, CrazySpeakHistory $crazy_speak_histories)
    {
        if ($this->permissionRepository->is('view_crazy_speak_history')) {
            return true;
        }

        return $user->id === $crazy_speak_histories->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_crazy_speak_history')) {
            return true;
        }

        return false;
    }

    public function update(User $user, CrazySpeakHistory $crazy_speak_histories)
    {
        if ($this->permissionRepository->is('update_crazy_speak_history')) {
            return true;
        }

        return $user->id === $crazy_speak_histories->user_id;
    }

    public function delete($user, CrazySpeakHistory $crazy_speak_histories)
    {
        if ($this->permissionRepository->is('delete_crazy_speak_history')) {
            return true;
        }

        return $user->id === $crazy_speak_histories->user_id;
    }

}
