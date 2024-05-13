<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\View\View;


class HomeController extends Controller
{
    public function __construct( private PostService $postService)
    {
    }
    public function home(): View
    {
        $posts = $this->postService->getUserPostsFeed(auth()->id());

        return view('pages.client.home', ['posts' => $posts]);
    }

    public function feed(): View
    {
        $posts = $this->postService->getPostList();

        return view('pages.client.home', ['posts' => $posts]);
    }

    public function overall(): View
    {
        $data =[
            'totalClients' => User::whereRole("client")->count(),
            'totalAdmins' => User::whereRole('admin')->count(),
            'totalPosts' => Post::count(),
            'recentPosts' => Post::recentPosts(),
        ];
        return view('pages.admin.overall', ['data' => $data]);
    }

}
