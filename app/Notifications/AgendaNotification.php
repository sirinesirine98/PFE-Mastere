<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgendaNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                ->line('Un nouveau rendez-vous a été ajouté à votre agenda.')
                ->line('Date: ' . $this->agenda->date)
                ->line('Heure: ' . $this->agenda->heure)
                ->line('Nom du patient: ' . $this->agenda->name)
                ->line('Email du patient: ' . $this->agenda->email)
                ->line('Téléphone du patient: ' . $this->agenda->phone)
                ->line('Message du patient: ' . $this->agenda->message)
                ->action('Voir le rendez-vous', url('/'))
                ->line('Merci d\'utiliser notre application de prise de rendez-vous.');
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
