<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        return $post->user_id === $user->id || $user->role->id === 1?
            Response::allow()
            : Response::deny("Not authorized to delete this Post");
    }
}
