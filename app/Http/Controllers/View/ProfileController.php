<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __invoke()
    {
        return view('pages.profile');
    }
}
