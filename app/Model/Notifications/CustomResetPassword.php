<?php

namespace App\Model\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;

class CustomResetPassword extends ResetPassword
{
    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Overrided method,
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $url = url(
            config('app.url').route('password.reset', 
                [
                    'token' => $this->token, 
                    'email' => $notifiable->getEmailForPasswordReset()
                ], 
                false)
        );

        return (new MailMessage)->view(
            'emails.reset-password', ['url' => $url]
        );
    }
}