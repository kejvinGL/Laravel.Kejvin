<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostListController extends Controller
{
    public function __invoke()
    {
        $data = Post::all();
        foreach ($data as $post){
            $user = User::find($post['user_id']);
            $post["poster"]= $user['username'];
            $post["avatar"]= $user->avatar();
        }
        return view('pages.posts', ['posts' => $data]);
    }


}
