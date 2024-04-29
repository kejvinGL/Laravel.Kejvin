<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $data['title'],
                'body' => $data['body'],
            ]);
            if ($data['media']) {
                (new MediaService)->store($data['media'], $post);
            }
            DB::commit();
            return $post;
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }

    }

    public function destroy(Post $post, bool $forceDelete = false)
    {
        try {
            DB::beginTransaction();
            $forceDelete ? $post->forceDelete() : $post->delete();
            (new CommentService)->destroyPostComments($post, $forceDelete);
            (new MediaService)->destroyPostMedia($post, $forceDelete);

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
    }

    public function destroyUserPosts(User $user, bool $forceDelete = false)
    {
        $forceDelete ? $user->posts()?->forceDelete() : $user->posts()?->delete();
    }

    public function restoreUserPosts(User $user)
    {
        $user->posts()?->restore();
    }


    public function getUserPosts(int|string|null $id)
    {
        return Post::SortedUserPosts($id)->paginate(5);
    }

    public function getPostList()
    {
        return Post::SortedPostList()->paginate(10);
    }


}
