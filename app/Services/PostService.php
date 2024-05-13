<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function store(array $data): Post
    {
        return DB::transaction(function () use ($data) {
            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $data['title'],
                'body' => $data['body'],
            ]);
            if (array_key_exists('media', $data)) {
                (new MediaService)->store($data['media'], $post);
            }
            return $post;
        });
    }

    public function destroy(Post $post, bool $forceDelete = false)
    {

        DB::transaction(function () use ($post, $forceDelete) {
            $forceDelete ? $post->forceDelete() : $post->delete();
            (new CommentService)->destroyPostComments($post, $forceDelete);
            (new MediaService)->destroyPostMedia($post, $forceDelete);
        });
    }

    public function destroyUserPosts(User $user, bool $forceDelete = false)
    {
        $forceDelete ? $user->posts()?->forceDelete() : $user->posts()?->delete();
    }

    public function restoreUserPosts(User $user)
    {
        $user->posts()?->restore();
    }


    public function getUserPostsFeed(int|string|null $id)
    {
        return Post::sortedUserPosts($id)->paginate(5);
    }


    public function getUserPosts(User $user)
    {
        return Post::whereBelongsTo($user)->get();
    }

    public function getPostList()
    {
        return Post::sortedPostList()->paginate(10);
    }


}
