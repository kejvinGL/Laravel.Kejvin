<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeletePostController extends Controller
{
    public function __invoke(Request $request, $id): RedirectResponse
    {

        Post::where("user_id" , $id )->delete();

        return back();
    }
}
