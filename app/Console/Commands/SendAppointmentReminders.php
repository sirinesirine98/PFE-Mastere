<?php
namespace App\Console\Commands;
use App\Models\Appointment;
use App\Notifications\AppointmentReminderNotification;
use Illuminate\Console\Command;
use Carbon\Carbon;


class SendAppointmentReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send appointment reminders to doctors and patients';

    public function handle()
    {
        $now = Carbon::now();
        $upcomingAppointments = Appointment::where('status', 'Approved')
            ->where('date', '>', $now)
            ->where('date', '<=', $now->addMinutes(20))
            ->get();

        foreach ($upcomingAppointments as $appointment) {
            // Envoyer la notification au médecin
            $doctor = $appointment->doctor;
            $doctor->notify(new AppointmentReminderNotification($appointment));

            // Envoyer la notification au patient
            $patient = $appointment->patient;
            $patient->notify(new AppointmentReminderNotification($appointment));
        }
    }
}
