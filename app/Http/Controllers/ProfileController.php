<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\EditAvatarRequest;
use App\Http\Requests\User\EditPasswordRequest;
use App\Http\Requests\User\EditUserDetailsRequest;
use App\Models\User;
use App\Notifications\DetailsChangedNotification;
use App\Notifications\PasswordChangedNotification;
use App\Services\MediaService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        return view('pages.profile');
    }

    public function details(EditUserDetailsRequest $request): RedirectResponse
    {
        Session::flash('tab', 'details');
        try {
            if ($this->userService->editDetails($request->validated(), auth()->user())) {
                auth()->user()->notify(new DetailsChangedNotification(auth()->user()));
            }

            return back()->with('success', 'User details updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'User details could not be updated. <br> ' . $e->getMessage());
        }
    }


    public function password(EditPasswordRequest $request, User $user)
    {
        Session::flash('tab', 'password');
        try {
            if ($this->userService->editPassword($request->validated(), auth()->user())) {
                $user->notify(new PasswordChangedNotification($user));
            }
            return back()->with('success', 'User password updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating user password.' . $e->getMessage());
        }
    }

    public function avatar(EditAvatarRequest $request)
    {
        Session::flash('tab', 'avatar');
        try {
            (new MediaService)->updateAvatar($request->validated());
            return back()->with('success', "Avatar changed sucessfully");
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating user avatar.' . $e->getMessage());
        }
    }
}
