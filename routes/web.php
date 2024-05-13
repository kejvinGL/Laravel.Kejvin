<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\Authentication\ForgotPasswordController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Authentication\ResetPasswordController;
use App\Http\Controllers\Authentication\VerificationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;


Route::get('create-transaction', [OrderController::class, 'createTransaction'])->name('create.transaction');
Route::get('process-transaction', [OrderController::class, 'processTransaction'])->name('process.transaction');
Route::get('success-transaction', [OrderController::class, 'successTransaction'])->name('success.transaction');
Route::get('cancel-transaction', [OrderController::class, 'cancelTransaction'])->name('cancel.transaction');

// Authentication Routes
Route::middleware(['guest', 'set.locale'])->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::get('register', [RegisterController::class, 'index'])->name('register');

    Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('auth/register', [RegisterController::class, 'register'])->name('auth.register');

});

Route::group(['prefix' => 'password'], function () {
    Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});
// verification Routes
Route::group(['prefix' => 'email'], function () {
    Route::get('verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('resend', [VerificationController::class, 'resend'])->name('verification.resend');
});


Route::middleware(['auth', 'set.locale'])->group(function () {
    Route::redirect('/', '/home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//    Client Routes
    Route::middleware('role:client')->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name("home");
        Route::get('feed', [HomeController::class, 'feed'])->name("feed");

        Route::post('posts/create', [PostController::class, 'store'])->name('post.store');
        Route::post('comments/create/{post}', [CommentController::class, 'store'])->name('comment.store');
    });

//    Admin Routes
    Route::middleware('role:admin')->group(function () {

        Route::prefix('datatables')->group(function () {
            Route::get('api_keys', [ApiKeyController::class, 'dataTable'])->name('get.api_keys.datatable');
            Route::get('orders', [OrderController::class, 'dataTable'])->name('get.orders.datatable');
            Route::get('posts', [PostController::class, 'dataTable'])->name('get.posts.datatable');
            Route::get('users', [UserController::class, 'dataTable'])->name('get.users.datatable');
        });

        Route::get('export/api_keys', [ApiKeyController::class, 'export'])->name('export.api_keys');
        Route::get('export/orders', [OrderController::class, 'export'])->name('export.orders');
        Route::get('export/users', [UserController::class, 'export'])->name('export.users');
        Route::get('import/api_keys/example', [ApiKeyController::class, 'example'])->name('import.api_keys.example');
        Route::get('import/users/example', [UserController::class, 'example'])->name('import.users.example');;
        Route::post('import/api_keys', [ApiKeyController::class, 'import'])->name('import.api_keys');
        Route::post('import/users', [UserController::class, 'import'])->name('import.users');


        Route::get('access', [UserController::class, 'create'])->name('access');
        Route::get('api_keys', [ApiKeyController::class, 'index'])->name('api_keys');
        Route::get('orders', [OrderController::class, 'index'])->name('order_list');
        Route::get('overall', [HomeController::class, 'overall'])->name("overall");
        Route::get('posts', [PostController::class, 'index'])->name('post_list');
        Route::get('users', [UserController::class, 'index'])->name('user_list');


        Route::name('admin.')->group(function () {
            Route::prefix('users')->group(function () {
                Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
                Route::delete('delete/{user}/force', [UserController::class, 'forceDestroy'])->name('user.force_destroy');
                Route::post('create', [UserController::class, 'store'])->name('user.create');
                Route::put('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
                Route::put('restore/{user}', [UserController::class, 'restore'])->name('user.restore');


            });
            Route::prefix('api_keys')->group(function () {
                Route::post('create', [ApiKeyController::class, 'store'])->name('api_key.store');
                Route::delete('delete/{key}', [ApiKeyController::class, 'destroy'])->name('api_key.destroy');
                Route::put('edit/{key}', [ApiKeyController::class, 'edit'])->name('api_key.edit');
            });
        });


    });
    Route::delete('posts/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy')->can('delete', 'post');
    Route::delete('comments/delete/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->can('delete', 'comment');

//    Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::name('profile.')->prefix('profile')->middleware('verified')->group(function () {
        Route::put('details', [ProfileController::class, 'details'])->name("details");
        Route::put('password', [ProfileController::class, 'password'])->name('password');
        Route::put('avatar', [ProfileController::class, 'avatar'])->name('avatar');
        Route::delete('delete/{user}', [UserController::class, 'forceDestroy'])->name('destroy')->can('forceDelete', 'user');
    });
});


Route::put('theme', ThemeController::class)->name('theme');
Route::put('lang', LangController::class)->name('lang');





