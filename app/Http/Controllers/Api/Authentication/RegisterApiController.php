<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegisterApiController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->storeClient($request->validated());

            Auth::login($user);

            $token = $user->createToken($request->email, ['create-post', 'delete-post', 'create-comment', 'delete-comment']);

            return response()->json([
                'status' => 'success',
                'message' => "User $user->name has been registered. API Token generated.",
                'token' => $token->plainTextToken,
            ], Response::HTTP_ACCEPTED);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'Login request could not be processed',
                'exception' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
