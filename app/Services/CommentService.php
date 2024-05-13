<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentService
{
    public function store($data, $id)
    {
       return Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $id,
            'body' => $data['body']
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->forceDelete();
    }

    public function destroyPostComments(Post $post, bool $forceDelete = false)
    {
        $forceDelete ? $post->comments()?->forceDelete() : $post->comments()?->delete();
    }

    public function destroyUserComments(User $user, bool $forceDelete = false)
    {
        $forceDelete ? $user->comments()?->forceDelete() : $user->comments()?->delete();
    }

    public function restoreUserComments(User $user)
    {
        $user->comments()?->restore();
    }

    public function getUserComments(User $user)
    {
        return Comment::whereBelongsTo($user)->get();
    }
}
