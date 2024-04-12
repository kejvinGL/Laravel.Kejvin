<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;

class AccessController extends Controller
{
    public function __invoke()
    {
        return view('pages.access');
    }
}
