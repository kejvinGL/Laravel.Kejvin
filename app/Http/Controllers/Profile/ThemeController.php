<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;

class ThemeController extends Controller
{
    public function __invoke()
    {
        try {

        User::find(auth()->id())->update(['darkmode' => !auth()->user()->darkmode]);

        } catch (\Exception $e) {

            Session::flash('error', 'An error occurred while updating user theme.');
            return back();

        }

        return back();
    }
}
