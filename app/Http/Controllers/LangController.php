<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function __invoke()
    {
        try {
            if (!in_array(request()->lang, ['en', 'al'])) {
                abort(400);
            }
            if (auth()->user()) {
                auth()->user()->update(['lang' => request()->lang]);
            } else {
                session(['lang' => request()->lang]);
            }
            return back();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating language.');
        }
    }
}
