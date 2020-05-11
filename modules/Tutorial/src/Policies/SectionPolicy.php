<?php

namespace Tutorial\Policies;

use Tutorial\Models\Section;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
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

    public function view(User $user, Section $sections)
    {
        if ($this->permissionRepository->is('view_section')) {
            return true;
        }

        return $user->id === $sections->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_section')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Section $sections)
    {
        if ($this->permissionRepository->is('update_section')) {
            return true;
        }

        return $user->id === $sections->user_id;
    }

    public function delete($user, Section $sections)
    {
        if ($this->permissionRepository->is('delete_section')) {
            return true;
        }

        return $user->id === $sections->user_id;
    }

}
