<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Symfony\Component\HttpFoundation\Response;

class LoginApiController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (Auth::attempt($request->validated(), $request->boolean('remember'))) {
                $user = auth()->user();
                if ($user === 2){
                    $token = $user->createToken($request->email, ['create-post', 'delete-post', 'create-comment', 'delete-comment']);
                }else{
                    $token = $user->createToken($request->email, ['delete-post', 'delete-comment', 'create-user', 'delete-user', 'show-users', 'show-posts', 'show-comments']);
                }
                return response()->json([
                   'status' => 'success',
                    'message' => "User $user->name has been authenticated. API Token generated.",
                    'token' => $token->plainTextToken,
                ], Response::HTTP_ACCEPTED);
            }
            else{
                return response()->json([
                    'status' => 'failure',
                    'message' => __('auth.failed'),
                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'Login request could not be processed',
                'exception' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User was logged out successfully',
        ]);
    }
}
