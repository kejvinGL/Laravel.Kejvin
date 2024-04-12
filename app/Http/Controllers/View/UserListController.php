<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\User;

class UserListController extends Controller
{
    public function __invoke()
    {
        $data = User::all();
        foreach ($data as $user){
            $user['avatar']= $user->avatar();
            $user['posts']= $user->posts()->count();
        }
        return view('pages.users', ['users' => $data]);
    }
}
