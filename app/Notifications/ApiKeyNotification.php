<?php

namespace App\Notifications;

use App\Models\ApiKey;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApiKeyNotification extends Notification
{
    use Queueable;

    private string $name;

    /**
     * Create a new notification instance.
     */
    public function __construct(private ApiKey $key)
    {
        $user = User::whereEmail($this->key->email)->first();
        if ($user) {
            $this->name = $user->name;
        } else {
            $this->name = 'User';
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Congrats, ' . $this->name . '!')
            ->line('The payment was successful and your API Key was generated.')
            ->line('You can access the Laravel.Kejvin API by adding \'x-api-key\' with value of the key below to the request body on the \'/api/key/\' subsite.')
            ->line($this->key->value)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
