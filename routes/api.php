<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('all', [\App\Http\Controllers\UserController::class, 'all']);

Route::post('user/new', [\App\Http\Controllers\UserController::class, 'new']);

