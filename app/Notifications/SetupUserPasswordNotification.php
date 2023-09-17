<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use PhpParser\Node\Expr\Cast\String_;

class SetupUserPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public User $user;
    public String $token;

    public function __construct(User $user)
    {
        //
        $this->user = $user;
        $tokens = Password::getRepository();
        $this->token = $tokens->create($this->user);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("SETUP PASSWORD FOR " . config('APP_NAME'))
                    ->line("Hello, {$this->user->name}")
                    ->line("You have received this email because you have been added as a user to the system, Use the link bellow to setup your password")
                    ->action('Setup Password', route("password.reset", ["token" => $this->token, "email" => $this->user->email]))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
