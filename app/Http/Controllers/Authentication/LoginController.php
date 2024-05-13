<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->validated(), $request->boolean('remember'))) {
                $request->session()->regenerate();
                Session::put('theme', auth()->user()->darkmode? 'black' : 'retro' );

                return redirect()->intended(route('home'));
            }
            else{
                return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
            }

        }catch (\Exception $e){
            return back()->with('error', "Login request could not be processed");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
