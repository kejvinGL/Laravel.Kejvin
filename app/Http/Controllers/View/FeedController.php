<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Post;


class FeedController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $posts = Post::latest()->get();
        foreach ($posts as $post) {
            $post->poster= $post->user()->first()->name;
            $post->comments = $post->comments()->get();
            $post->avatar = $post->user()->first()->avatar();
            foreach ($post['comments'] as $comment) {
                $comment->poster = $comment->user()->first()->name;
                $comment->avatar = $comment->user()->first()->avatar();
            }
        }

        return view('pages.home', ['posts' => $posts]);
    }
}
