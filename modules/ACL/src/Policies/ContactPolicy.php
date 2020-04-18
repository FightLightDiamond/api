<?php

namespace ACL\Policies;

use ACL\Models\Contact;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
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

    public function view(User $user, Contact $contacts)
    {
        if ($this->permissionRepository->is('view_contact')) {
            return true;
        }

        return $user->id === $contacts->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create_contact')) {
            return true;
        }

        return false;
    }

    public function update(User $user, Contact $contacts)
    {
        if ($this->permissionRepository->is('update_contact')) {
            return true;
        }

        return $user->id === $contacts->user_id;
    }

    public function delete($user, Contact $contacts)
    {
        if ($this->permissionRepository->is('delete_contact')) {
            return true;
        }

        return $user->id === $contacts->user_id;
    }

}
