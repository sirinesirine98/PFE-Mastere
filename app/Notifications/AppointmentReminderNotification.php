<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminderNotification extends Notification
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
    $appointmentDate = $this->appointment->date;
    $doctorName = $this->appointment->doctor;
    $patientName = $this->appointment->name;

    return (new MailMessage)
        ->subject('Rappel de rendez-vous')
        ->greeting('Bonjour ' . $patientName . '!')
        ->line('Vous avez un rendez-vous avec le Dr. ' . $doctorName . ' le ' . $appointmentDate)
        ->line('Veuillez vous connecter à notre application de téléconsultation pour plus de détails.')
        ->action('Accéder à l\'application', url('/'))
        ->line('Merci de votre confiance et à bientôt!');
}
 /*
 
 Mail::send(
                        'emails.acceptRequestChangePaymentMode',
                        ['order' => $order],
                        function ($message) use ($email) {
                            $message->to($email, 'ARVEA')->subject('Acceptation de la demande de changer mode de paiement');
                        }
                    );
                    
                    */ 

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
