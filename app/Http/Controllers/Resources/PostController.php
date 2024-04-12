<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string', 'max:500'],
        ]);

        Post::create(['user_id'=> auth()->id(), 'title'=> $request['title'], 'body'=> $request['body']]);

        return back();
    }

    public function destroy($id){

        Post::destroy([$id]);

        return back();

    }
}
