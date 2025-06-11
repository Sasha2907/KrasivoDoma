<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PreorderReplied extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //     ->subject('Ответ на вашу заявку на предзаказ')
        //     ->greeting('Здравствуйте, ' . $notifiable->name . '!')
        //     ->line('Администратор ответил на вашу заявку:')
        //     ->line($this->message)
        //     // ->action('Перейти в профиль', url('/profile')) // замените ссылку при необходимости
        //     ->line('Спасибо за использование нашего конструктора!');
        
        return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Ответ на вашу заявку')
        ->view('emails.preorder_reply', [
            'user' => $notifiable,
            'adminMessage' => $this->message,
        ]);
    }
}
