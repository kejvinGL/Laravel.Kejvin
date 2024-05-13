<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentApiController extends Controller
{

    public function __construct(private CommentService $commentService)
    {
    }

    public function store(StoreCommentRequest $request, int $post_id): JsonResponse
    {
        try {

        $comment = $this->commentService->store($request->validated(), $post_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment has been created.',
            'comment' => new CommentResource($comment),
        ], Response::HTTP_ACCEPTED);
        }catch (Exception $e){
                return response()->json([
                    'status' => 'failure',
                    'error' => $e->getMessage(),
                ], Response::HTTP_BAD_REQUEST);
        }
    }
}
