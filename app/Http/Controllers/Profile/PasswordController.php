<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        Session::put('tab', 'password');
        $request->validate([
            'current_password'=> ['required', 'string', 'current_password:web'],
            'new_password' => ['required', 'string', 'min:8', 'different:current_password', 'confirmed'],
        ]);
        try {
            return self::updatePassword($request);
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while updating user password.');
            return back();
        }

    }

    private static function updatePassword($request): RedirectResponse
    {
        User::find(auth()->id())
            ->update(['password' => $request->new_password]);

        Session::flash('success', 'User password updated successfully.');
        return back();
    }
}
