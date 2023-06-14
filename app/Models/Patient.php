<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'IPP';
    //protected $table = 'patient';

     protected $fillable = [
        'nomdenaissance',
        'prenom',
        'datedenaissance',
        'ville',
        'telephone',
        'numdossier',
        'actions',
        'doctor_id',
        // Ajoutez ici les attributs correspondant aux champs supplémentaires du formulaire de rendez-vous
    ];

     public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    
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

    public function appointments()
{
    return $this->hasMany(Appointment::class);
}



public function demandeurRdv()
{
    return $this->belongsTo(DemandeurRdv::class, 'demandeur_id');
}


}



