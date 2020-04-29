<?php

namespace Tutorial\Policies;

use Tutorial\Models\Lesson;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
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

    public function view(User $user, Lesson $lessons)
    {
        if ($this->permissionRepository->is('view_lesson')) {
            return true;
        }

        return $user->id === $lessons->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_lesson')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Lesson $lessons)
    {
        if ($this->permissionRepository->is('update_lesson')) {
            return true;
        }

        return $user->id === $lessons->user_id;
    }

    public function delete($user, Lesson $lessons)
    {
        if ($this->permissionRepository->is('delete_lesson')) {
            return true;
        }

        return $user->id === $lessons->user_id;
    }

}
