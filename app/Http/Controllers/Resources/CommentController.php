<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:150'],
        ]);

        Comment::create(['user_id'=> auth()->id(), 'post_id'=> $id  , 'body'=> $request['body']]);

        return back();
    }


    public function destroy(Request $request, $id)
    {

        Comment::destroy(['id'=> $id  , 'body'=> $request['body']]);

        return back();
    }
}
