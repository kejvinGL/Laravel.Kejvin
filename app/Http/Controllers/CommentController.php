<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StoreCommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\MediaService;
use App\Services\PostService;
use App\Services\UserService;

class CommentController extends Controller
{
    public function __construct( private commentService $commentService)
    {
    }

    public function store(StoreCommentRequest $request, int $post_id)
    {
        try {
            $this->commentService->store($request->validated(), $post_id);
            return back()->with('success', 'Comment created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Comment creation failed.');
        }
    }


    public function destroy(Comment $comment)
    {
        try {
            $this->commentService->destroy($comment);
            return back()->with('success', 'Comment deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Comment could not be deleted.');
        }
    }
}
