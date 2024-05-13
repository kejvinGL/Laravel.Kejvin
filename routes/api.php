<?php

use App\Http\Controllers\Api\Authentication\LoginApiController;
use App\Http\Controllers\Api\Authentication\RegisterApiController;
use App\Http\Controllers\Api\CommentApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('verify.api.key')->prefix('key')->group(function () {
    Route::get('users', [UserApiController::class, 'all']);
    Route::get('users/{user}', [UserApiController::class, 'show'])->middleware('ability:show-posts');
    Route::get('users/{user}/posts', [UserApiController::class, 'getUserPosts']);
    Route::get('users/{user}/comments', [UserApiController::class, 'getUserComments']);

    Route::post('users/create', [UserApiController::class, 'store']);
    Route::delete('delete/{user}', [UserApiController::class, 'destroy']);
    Route::delete('delete/{user}/force', [UserApiController::class, 'forceDestroy']);
});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::middleware('api.role:admin')->group(function () {
        Route::get('users', [UserApiController::class, 'all']);
        Route::get('users/{user}', [UserApiController::class, 'show'])->middleware('ability:show-posts');
        Route::get('users/{user}/posts', [UserApiController::class, 'getUserPosts']);
        Route::get('users/{user}/comments', [UserApiController::class, 'getUserComments']);

        Route::post('users/create', [UserApiController::class, 'store']);
        Route::delete('delete/{user}', [UserApiController::class, 'destroy']);
        Route::delete('delete/{user}/force', [UserApiController::class, 'forceDestroy']);
    });

    Route::post('posts/create', [PostApiController::class, 'store'])->middleware('api.role:client');
    Route::post('comments/create/{post}', [CommentApiController::class, 'store'])->name('comment.store');

    Route::get('posts', [PostApiController::class, 'all']);
    Route::get('posts/{post}', [PostApiController::class, 'show']);
    Route::get('posts/{post}/comments', [PostApiController::class, 'getPostComments']);

    Route::post('logout', [LoginApiController::class, 'logout']);

    Route::get('profile', [ProfileApiController::class, 'show']);

    Route::prefix('profile')->group(function () {
        Route::delete('delete', [ProfileApiController::class, 'destroy']);
        Route::put('details', [ProfileApiController::class, 'details']);
        Route::put('password', [ProfileApiController::class, 'password']);
        Route::put('avatar', [ProfileApiController::class, 'avatar']);
    });

});

Route::post('login', [LoginApiController::class, 'login']);
Route::post('register', [RegisterApiController::class, 'register']);

Route::view('/', 'pages.swagger');

