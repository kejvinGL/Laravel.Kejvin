<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function __invoke()
    {
        try {
            if (auth()->check()) {
                (new UserService)->toggleTheme();
            } else {
                $theme = session('theme');
                session(['theme' => $theme === 'retro' ? 'black' : 'retro']);
            }

            return back();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating theme.');
        }
    }
}
