<?php

namespace App\Policies;

use App\Contracts\UsersPermissions;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function read(User $user)
    {
        return $user->hasPermission(UsersPermissions::READ);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Contact $contact
     * @return mixed
     */
    public function write(User $user)
    {
        return $user->hasPermission(UsersPermissions::WRITE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Contact $contact
     * @return mixed
     */
    public function remove(User $user)
    {
        return $user->hasPermission(UsersPermissions::REMOVE);
    }
}
