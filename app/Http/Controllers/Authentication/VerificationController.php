<?php

namespace App\Http\Controllers\Authentication;

use App\Events\UserVerified;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\VerificationConfirmedNotification;
use App\Services\LinkGeneratorService;
use App\Services\UserService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

    public function verify(Request $request)
    {
        $user = (new UserService)->getUserById($request->id);

        if (!$request->hasValidSignature()) {
            return redirect(route('home'))->with('error', 'Invalid or Expired Verification link.');
        }

        if ($request->user() === null) {
            return redirect('login')->with('error', 'Login to your account before you can verify');
        }


        if ($user->id != $request->user()?->id) {
            return redirect(route('home'))->with('error', "Wrong User tried to be verified.");
        }

        if ($user->hasVerifiedEmail()) {
            return redirect(route('home'))->with('error', "User is already verified.");
        }

        if ($user->markEmailAsVerified()) {
            UserVerified::dispatch($request->user());
        }
            return redirect(route('profile'))->with('success', 'User Verified successfully');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return back()->with('error', "User is already verified.");
        }
        $link = (new LinkGeneratorService())->createEmailVerificationLink($request->user());
        $request->user()->notify(new VerifyEmailNotification($request->user(), $link));
        return back()->with('success', "Verification link sent to your email.");
    }


}
