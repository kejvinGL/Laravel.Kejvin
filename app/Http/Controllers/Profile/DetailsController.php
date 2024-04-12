<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use function Laravel\Prompts\error;
use function Laravel\Prompts\table;

class DetailsController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Session::put('tab', 'details');

        $request->validate([
            'new_username' => ['required', 'string', 'max:50',  Rule::unique('users', 'username')->ignore(auth()->id())],
            'new_email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users', 'username')->ignore(auth()->id())],
        ]);
        try {
            return self::updateDetails($request);
        } catch (\Exception $e) {
            Session::flash('error', 'User details could not be updated.');
            return back();
        }

    }

    private static function updateDetails($request)
    {
        $user = User::find(auth()->id())
            ->update(['username' => $request->new_username, 'email' => $request->new_email]);

        Session::flash('success', 'User details updated successfully.');
        return back();
    }
}
