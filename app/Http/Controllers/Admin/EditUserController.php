<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class EditUserController
{
    public function __invoke(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'new_username' => ['required', 'string', 'max:50',  Rule::unique('users', 'username')->ignore(auth()->id())],
            'new_email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users', 'username')->ignore(auth()->id())],
        ]);
        try {
            return self::editUser($request, $id);
        } catch (\Exception $e) {
            Session::flash('error', 'User details could not be updated.');
            return back();
        }

    }

        private static function editUser($request, $id)
    {
        $user = User::find($id)
            ->update(['username' => $request->new_username, 'email' => $request->new_email]);

        Session::flash('success', 'User details updated successfully.');
        return back();
    }
}
