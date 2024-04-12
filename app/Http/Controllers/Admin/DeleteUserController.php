<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function __invoke(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'delete_password' => 'required|current_password:web',
        ]);

        $user = User::find($id);

        Media::where("user_id" , $user['id'])->delete();
        Post::where("user_id" , $user['id'])->delete();

        $user->delete();

        return back();
    }
}
