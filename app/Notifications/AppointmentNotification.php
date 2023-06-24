<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AppointmentNotification extends Notification
{
    protected $appointmentId;
    protected $doctor;
    protected $patient;
    protected $roomId;

    public function __construct($appointmentId, $doctor, $patient, $roomId)
    {
        $this->appointmentId = $appointmentId;
        $this->doctor = $doctor;
        $this->patient = $patient;
        $this->roomId = $roomId;
    }

    public function via($notifiable)
    {
        return ['mail', 'broadcast', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande de rendez-vous')
            ->line('Vous avez reçu une nouvelle demande de rendez-vous.')
            ->line('Docteur : ' . $this->doctor)
            ->line('Patient : ' . $this->patient)
            ->action('Voir les détails', url('/appointments/' . $this->appointmentId));
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'appointment_id' => $this->appointmentId,
            'doctor' => $this->doctor,
            'patient' => $this->patient,
            'room_id' => $this->roomId,
        ]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'appointment_id' => $this->appointmentId,
            'doctor' => $this->doctor,
            'patient' => $this->patient,
            'room_id' => $this->roomId,
        ];
    }
}
