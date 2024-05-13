<?php

namespace App\Http\Controllers\Api;

use App\Events\UserDeleted;
use App\Http\Controllers\Controller;

use App\Http\Requests\Posts\StoreUserRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ApiService;
use App\Services\CommentService;
use App\Services\MediaService;
use App\Services\PostService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserApiController extends Controller
{
    public function __construct(private ApiService $apiService, private UserService $userService)
    {
    }

    public function all(): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'users' => UserResource::collection($this->userService->getAllUsers()),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show(User $user): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'user' => new UserResource($user),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {

            $user = $this->userService->store($request->validated());

            if ($user->role->id === 2) {
                $token = $this->apiService->createClientToken($user);
            } else {
                $token = $this->apiService->createAdminToken($user);
            }
            return response()->json([
                'status' => 'success',
                'message' => "User $user->name has been registered. API Token generated.",
                'token' => $token->plainTextToken,
            ], Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'User could not be registered.',
                'exception' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getUserPosts(User $user): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'user' => $user->id,
                'post_count' => count($user->posts),
                'posts' => PostResource::collection((new PostService)->getUserPosts($user)),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function getUserComments(User $user): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'user' => $user->id,
                'comments_count' => count($user->comments),
                'comments' => CommentResource::collection((new CommentService())->getUserComments($user)),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        try {
            $this->userService->destroy($user, false);
            return response()->json([
                'status' => 'success',
                'message' => 'User ' . $user->name . ' was deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'error', 'An error occurred while deleting user. ',
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function forceDestroy(User $user): JsonResponse
    {
        try {
            $this->userService->destroy($user, true);
            return response()->json([
                'status' => 'success',
                'message' => 'User ' . $user->name . ' was deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'error', 'An error occurred while deleting user. ',
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
