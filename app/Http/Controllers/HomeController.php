<?php

namespace App\Http\Controllers;

use App\Mail\TestingMail;
use App\Models\Post;
use App\Models\User;
use App\Services\MediaService;
use App\Services\PostService;
use App\Services\UserService;


class HomeController extends Controller
{
    public function __construct( private PostService $postService)
    {
    }
    public function home()
    {
        $posts = $this->postService->getUserPosts(auth()->id());

        return view('pages.home', ['posts' => $posts]);
    }

    public function feed()
    {
        $posts = $this->postService->getPostList();

        return view('pages.home', ['posts' => $posts]);
    }

    public function overall()
    {
        $data =[
            'totalClients' => User::whereRole("client")->count(),
            'totalAdmins' => User::whereRole('admin')->count(),
            'totalPosts' => Post::count(),
            'recentPosts' => Post::recentPosts(),
        ];

        return view('pages.overall', ['data' => $data]);
    }

}
