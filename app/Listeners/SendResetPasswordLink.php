<?php

namespace App\Listeners;

use App\Events\ResetPasswordRequested;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendResetPasswordLink implements ShouldQueue
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
    public function handle(ResetPasswordRequested $event): void
    {
        $event->user->notify(new ResetPasswordNotification($event->user, $event->link));
    }
}
