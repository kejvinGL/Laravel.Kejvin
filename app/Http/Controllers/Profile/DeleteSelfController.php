<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteSelfController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'delete_password' => 'required|current_password:web',
        ]);

        $user = auth()->user();

        Media::where("user_id" , $user['id'])->delete();
        Post::where("user_id" , $user['id'])->delete();

        $user->delete();


        return redirect(route('login'));
    }
}
