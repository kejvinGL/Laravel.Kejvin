<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditAvatarRequest;
use App\Http\Requests\User\EditPasswordApiRequest;
use App\Http\Requests\User\EditProfileDetailsRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;
use App\Services\MediaService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ProfileApiController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function show(): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'The currently authenticated user.',
                'user' => new UserResource(auth()->user())
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'No authenticated User was found.',
            ]);
        }
    }

    public function avatar(EditAvatarRequest $request): JsonResponse
    {
        try {
            $avatar = (new MediaService)->updateAvatar($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Avatar updated successfully',
                'avatar' => new MediaResource($avatar),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'Avatar could not be updated',
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function details(EditProfileDetailsRequest $request)
    {
        try {
            $this->userService->editDetails($request->validated(), auth()->user());
            return response()->json([
                'status' => 'success',
                'message' => 'Authenticated User\'s details updated successfully',
                'avatar' => new UserResource(auth()->user()),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'error', 'User details could not be updated.',
                'exception' => $e->getMessage(),
            ]);
        }
    }


    public function password(EditPasswordApiRequest $request)
    {
        try {
            $this->userService->editPassword($request->validated(), auth()->user());
            return response()->json([
                'status' => 'success',
                'message' => 'Authenticated User\'s password updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'error', 'An error occurred while updating user password.',
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            $this->userService->destroy($request->user(), true);
            return response()->json([
                'status' => 'success',
                'message' => 'Authenticated User was deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'error', 'An error occurred while deleting user.',
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
