<?php

namespace ETest\Policies;

use ETest\Models\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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

    public function view(User $user, Question $questions)
    {
        if ($this->permissionRepository->is('view_question')) {
            return true;
        }

        return $user->id === $questions->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_question')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Question $questions)
    {
        if ($this->permissionRepository->is('update_question')) {
            return true;
        }

        return $user->id === $questions->user_id;
    }

    public function delete($user, Question $questions)
    {
        if ($this->permissionRepository->is('delete_question')) {
            return true;
        }

        return $user->id === $questions->user_id;
    }

}
