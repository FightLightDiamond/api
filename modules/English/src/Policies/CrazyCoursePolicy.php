<?php

namespace English\Policies;

use English\Models\CrazyCourse;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrazyCoursePolicy
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

    public function view(User $user, CrazyCourse $crazy_courses)
    {
        if ($this->permissionRepository->is('view_crazy_course')) {
            return true;
        }

        return $user->id === $crazy_courses->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_crazy_course')) {
            return true;
        }

        return false;
    }

    public function update(User $user, CrazyCourse $crazy_courses)
    {
        if ($this->permissionRepository->is('update_crazy_course')) {
            return true;
        }

        return $user->id === $crazy_courses->user_id;
    }

    public function delete($user, CrazyCourse $crazy_courses)
    {
        if ($this->permissionRepository->is('delete_crazy_course')) {
            return true;
        }

        return $user->id === $crazy_courses->user_id;
    }

}
