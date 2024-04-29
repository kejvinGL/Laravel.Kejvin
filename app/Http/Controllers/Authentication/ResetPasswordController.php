<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        if ($request->hasValidSignature()) {
            return view('auth.passwords.reset')->with(
                [
                    'token' => $request->token,
                    'email' => $request->email,
                ]
            );
        } else {
            abort('403', 'Invalid or Expired Token');
        }
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $resetRequest = $this->resetRequest($request->validated('token'));
            $user = User::where('email', $request->validated('email'))->first();

            $this->verifyUrlTimeLimit($resetRequest);
            $this->verifyUrlUsage($resetRequest);
            $this->verifyEmailInput($user, $resetRequest);
            $this->verifyUrlUsage($resetRequest);

            return $this->resetPassword($user, $request->validated('password'), $resetRequest);
        } catch (\Exception $e) {
            return back()->with('error', "Could not process the reset request");
        }
    }

    private function resetPassword($user, $password, $resetRequest)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        event(new PasswordReset($user));

        $this->markTokenAsUsed($resetRequest);

        return $this->resetPasswordSuccess();
    }

    private function resetPasswordSuccess()
    {
        return redirect(route('login'))->with('success', 'Changed Password successfully');
    }

    private function resetPasswordFailure()
    {
        return redirect(route('login'))->with('error', 'The email used is not correct.');
    }

    private function timeLimitFailure()
    {
        return redirect(route('login'))->with('error', 'This Reset link has expired');
    }

    private function usedUrlFailure()
    {
        return redirect(route('login'))->with('error', 'This Reset link has expired');
    }

    private function verifyEmailInput(User $user, $resetRequest)
    {
        if ($user->email !== $resetRequest->email) {
            $this->resetPasswordFailure();
        }
    }

    private function verifyUrlTimeLimit($resetRequest)
    {
        if (now()->diffInMinutes($resetRequest->created_at) > 30) {
            $this->timeLimitFailure();
        }
    }

    private function verifyUrlUsage($resetRequest)
    {
        if ($resetRequest->used) {
            $this->usedUrlFailure();
        }
    }

    private function markTokenAsUsed($resetRequest)
    {
        return DB::table('password_reset_tokens')->where(['token'=> $resetRequest->token])->update(['used' => true]);
    }

    private function resetRequest($token)
    {
        return DB::table('password_reset_tokens')->where('token', $token)->first();
    }
}
