<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmailCustom extends Notification
{
    /**
     * The callback that should be used to create the verify email URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable): array|string
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return $this->buildMailMessage($verificationUrl);
    }

    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email Address'), $url)
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable): string
    {
        $params = [
            'expires' => Carbon::now()
                ->addMinutes(Config::get('auth.verification.expire', 60))
                ->getTimestamp(),
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ];
        ksort($params);

        // then create API url for verification. my API have `/api` prefix,
        // so i don't want to show that url to users
        $url = URL::route(
            'verification.verify',
            $params,
            true
        );

        // get APP_KEY from config and create signature
        $key = config('app.key');
        $signature = hash_hmac('sha256', $url, $key);

        // generate url for yous SPA page to send it to user
        return config('app.frontend_url') . '/email/verify' . '?' . http_build_query($params + compact('signature'), false);

    }


    /**
     * Set a callback that should be used when creating the email verification URL.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function createUrlUsing($callback): void
    {
        static::$createUrlCallback = $callback;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback): void
    {
        static::$toMailCallback = $callback;
    }
}
