<?php

namespace ETest\Policies;

use ETest\Models\QuestionTest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionTestPolicy
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

    public function view(User $user, QuestionTest $question_tests)
    {
        if ($this->permissionRepository->is('view_question_test')) {
            return true;
        }

        return $user->id === $question_tests->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_question_test')) {
            return true;
        }

        return false;
    }

    public function update(User $user, QuestionTest $question_tests)
    {
        if ($this->permissionRepository->is('update_question_test')) {
            return true;
        }

        return $user->id === $question_tests->user_id;
    }

    public function delete($user, QuestionTest $question_tests)
    {
        if ($this->permissionRepository->is('delete_question_test')) {
            return true;
        }

        return $user->id === $question_tests->user_id;
    }

}
