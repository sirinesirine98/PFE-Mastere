<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Notifications\Notifiable;


class Appointment extends Model
{
    use HasFactory;

    use Notifiable;

     protected $fillable = [
    'name',
    'email',
    'phone',
    'date',
    'message',
];

   /* protected $dates = ['date'];

    public function durationInMinutes(): int
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    public function updatePatientTable()
    {
        // Check if the appointment has a user ID and the patient exists in the database
        if ($this->user_id && $patient = Patient::find($this->user_id)) {
            // Update the patient's data
            $patient->name = $this->name;
            $patient->email = $this->email;
            $patient->phone = $this->phone;
            $patient->save();
        } else {
            // If the patient doesn't exist, create a new patient
            $patient = new Patient();
            $patient->name = $this->name;
            $patient->email = $this->email;
            $patient->phone = $this->phone;
            $patient->save();
        }
    }

    public function appointment(Request $request)
    {
        $data = new Appointment(); 
        $data->name=$request->name;
        $data->email=$request->email;
        $data->date=$request->date;
        $data->phone=$request->number;
        $data->message=$request->message;
        $data->doctor=$request->doctor;
        $data->status='En cours';
        if (Auth::id()) { 
            $data->user_id=Auth::user()->id;
        }
        $data->save();

        $data->updatePatientTable();

        dd($patient->user_id);

        return redirect()->back()->with('message','Rendez-vous ajouter avec succées !');
    }*/

}