<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function update(User $user): Response
    {
        return request('user')->id === $user->id ?
            Response::allow()
            : Response::deny("Not Authorized to update this user.");
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): Response
    {
        return request('user') === $user->id ?
            Response::allow()
            : Response::deny("Not Authorized to delete this user.");
    }

    public function forceDelete(User $user): Response
    {
        return request('user')->id === $user->id ?
            Response::allow()
            : Response::deny("Not Authorized to delete this user.");
    }
}
