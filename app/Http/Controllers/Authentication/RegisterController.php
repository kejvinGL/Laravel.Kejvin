<?php

namespace App\Http\Controllers\Authentication;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\LinkGeneratorService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
           $user = $this->userService->storeClient($request->validated());

            $link = (new LinkGeneratorService())->createEmailVerificationLink($user);
            UserRegistered::dispatch($user, $link);

            Auth::login($user);
            return redirect(route('home'));
        }catch (\Exception $e){
           return back()->with('error', $e->getMessage());
        }
    }
}
