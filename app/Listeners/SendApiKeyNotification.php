<?php

namespace App\Listeners;

use App\Events\ApiKeyCreated;
use App\Notifications\ApiKeyNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendApiKeyNotification implements ShouldQueue
{
    use Queueable;

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
    public function handle(ApiKeyCreated $event): void
    {
        dd($event);
        Notification::route('mail', $event->key->email)->notify(new ApiKeyNotification($event->key));
    }
}
