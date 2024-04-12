<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $posts = $user->posts()->get();
        foreach ($posts as $post) {
            $post->comments = $post->comments()->get();
            $post->avatar = $post->user()->first()->avatar();
            foreach ($post['comments'] as $comment) {
                $comment['poster'] = $comment->user()->first()->name;
                $comment['avatar'] = $comment->user()->first()->avatar();
            }
        }

        return view('pages.home', ['posts' => $posts]);
    }
}
