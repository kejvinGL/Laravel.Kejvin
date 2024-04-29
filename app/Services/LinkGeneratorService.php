<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\URL;

class LinkGeneratorService
{
    public function createEmailVerificationLink(User $user){
        return URL::signedRoute('verification.verify',['id' =>$user->id], now()->addHour());
    }

    public function createResetPasswordLink(string $token)
    {
        return URL::signedRoute('password.reset', ['token' => $token], now()->addHour());
    }
}
