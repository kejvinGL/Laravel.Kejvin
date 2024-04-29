<?php

namespace App\Http\Controllers\Authentication;

use App\Events\ResetPasswordRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use App\Services\LinkGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {

        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->validated('email'))->first();

            $token = $this->generateResetToken($user);

            $link = (new LinkGeneratorService)->createResetPasswordLink($token);

            if (ResetPasswordRequested::dispatch($user, $link)){
                return $this->sendEmailSuccess();
            } else {
                return $this->sendEmailFailure($request);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'The Password reset link could not be sent.' . $e->getMessage());
        }


    }

    private function sendEmailSuccess()
    {
        return back()
            ->with('success', "The Password Reset link was sent to your email.");
    }

    private function sendEmailFailure(Request $request)
    {
        return back()
            ->withInput($request->only('email'))
            ->with('error', "The Password Reset link could not be sent.");
    }

    private function generateResetToken($user){

        $token = Str::random(60);
        $token = Hash::make($token);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email]
            ,[
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
                'used' => false,
            ]);

        return $token;
    }



}
