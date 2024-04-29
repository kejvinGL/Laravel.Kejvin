<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use App\Notifications\DetailsChangedNotification;
use App\Notifications\UserDeletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserDeletedNotification implements ShouldQueue
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
    public function handle(UserDeleted $event): void
    {
        $event->user->notify(new UserDeletedNotification($event->user));
    }
}
