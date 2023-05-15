<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'IPP';

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'IPPP');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function teleconsultation()
    {
        return $this->hasOne(Teleconsultation::class, 'prenom_patient');
    }

    public function fichierPatient()
    {
        return $this->hasOne(FichierPatient::class, 'IPPP');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Rest of the model code...
}



