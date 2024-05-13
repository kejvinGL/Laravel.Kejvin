<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostApiController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function all(): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'users' => PostResource::collection(Post::all()),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show(Post $post): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'post' => new PostResource($post),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        try {
            $post = $this->postService->store($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Post has been created.',
                'post' => (new PostResource($post)),
            ], Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'Post could not be created.',
                'exception' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function getPostComments(Post $post): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'post' => $post->id,
                'comments' => CommentResource::collection($post->comments),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
