<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\EditAvatarRequest;
use App\Http\Requests\User\EditPasswordRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use App\Services\MediaService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{

    public function index()
    {
        return view('pages.profile');
    }

    public function details(EditUserRequest $request, User $user): RedirectResponse
    {
        Session::flash('tab', 'details');
        try {
            (new UserService)->editDetails($request->validated(), $user);
            return back()->with('success', 'User details updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'User details could not be updated. <br> ' . $e->getMessage());
        }
    }


    public function password(EditPasswordRequest $request, User $user)
    {
        Session::flash('tab', 'password');
        try {
            (new UserService)->editPassword($request->validated(), $user);
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
