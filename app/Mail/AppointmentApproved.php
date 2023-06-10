<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $date;
    public $doctor;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $date
     * @return void
     */
    public function __construct($name, $date , $doctor)
    {
        $this->name = $name;
        $this->date = $date;
        $this->doctor = $doctor;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appointment Approved')
            ->view('emails.appointment.approved');
    }
}
