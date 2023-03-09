<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetRequest extends Notification
{
    use Queueable;
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
       //$url = url('api/v1/password/find/'.$this->token);
       //$url = 'http://localhost:3000/login/reset-password/'.$this->token;
       //$url = 'http://192.168.1.107:3000/login/reset-password/'.$this->token;
       $url = 'https://www.goviideo.gotopdev.com/login/reset-password/'.$this->token;
        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->greeting('¡Hola!')
           // ->image('https://laravel.com/img/favicon/favicon.ico')
            ->line('Estás recibiendo este email porque se ha solicitado un cambio de contraseña para tu cuenta.')
            ->action('Restablecer contraseña', url($url))
            ->line('Este enlace para restablecer la contraseña caduca en 60 minutos.')
            ->line('Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este e-mail.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
