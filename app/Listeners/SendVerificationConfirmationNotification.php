<?php

namespace App\Listeners;

use App\Events\UserVerified;
use App\Notifications\VerificationConfirmedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationConfirmationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserVerified $event): void
    {
        $event->user->notify(new VerificationConfirmedNotification($event->user));
    }
}
