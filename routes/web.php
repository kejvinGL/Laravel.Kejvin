<?php

use App\Http\Controllers\Admin\CreateUserController;
use App\Http\Controllers\Admin\DeletePostController;
use App\Http\Controllers\Admin\DeleteUserController;
use App\Http\Controllers\Admin\EditUserController;
use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\Profile\DeleteSelfController;
use App\Http\Controllers\Profile\DetailsController;
use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ThemeController;
use App\Http\Controllers\Resources\CommentController;
use App\Http\Controllers\Resources\PostController;
use App\Http\Controllers\View\AccessController;
use App\Http\Controllers\View\FeedController;
use App\Http\Controllers\View\HomeController;
use App\Http\Controllers\View\OverallController;
use App\Http\Controllers\View\PostListController;
use App\Http\Controllers\View\ProfileController;
use App\Http\Controllers\View\UserListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::middleware('auth')->group(function () {

    Route::redirect('/', '/home');
    Route::get('/home', HomeController::class)->name("Home")->middleware('client');
    Route::get('/feed', FeedController::class)->name("Feed")->middleware('client');

    Route::middleware("admin")->group(function () {
        Route::get('overall', OverallController::class)->name('Overall');
        Route::get('posts', PostListController::class)->name('PostList');
        Route::get('users', UserlistController::class)->name('UserList');
        Route::get('access', AccessController::class)->name('Access');

        Route::name('admin.')->group(function () {
            Route::post('create', CreateUserController::class)->name('create');
            Route::delete('user/delete/{id}', DeleteUserController::class)->name('user.destroy');
            Route::delete('post/delete/{id}', DeletePostController::class)->name('post.destroy');
            Route::put('edit/{id}', EditUserController::class)->name('edit');
        });
    });

    Route::get('/profile', ProfileController::class)->name('Profile');

    Route::name('profile.')->prefix('profile')->group(function () {
        Route::put('details', DetailsController::class)->name("details");
        Route::put('password', PasswordController::class)->name('password');
        Route::put('avatar', AvatarController::class)->name('avatar');
        Route::delete('delete', DeleteSelfController::class)->name('destroy');
        Route::put('theme', ThemeController::class)->name('theme');
    });

    Route::resource('post', PostController::class)->only(['store', 'destroy']);

    Route::post('comment/{id}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
});



