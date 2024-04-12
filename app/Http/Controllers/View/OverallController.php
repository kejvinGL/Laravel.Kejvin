<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class OverallController extends Controller
{
    public function __invoke()
    {
        $data =[
            'totalClients' => User::where("role_id",2)->count(),
            'totalAdmins' => User::where("role_id", 1 )->count(),
            'totalPosts' => Post::all()->count(),
            'recentPosts' => Post::where('created_at', '>=', now()->subDay())->count()];
        return view('pages.overall', ['data' => $data]);
    }
}
