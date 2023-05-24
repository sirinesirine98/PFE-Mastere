<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FichierPatient extends Model
{

    public function teleconsultations()
    {
        return $this->belongsToMany(Teleconsultation::class, 'fichier_patient_teleconsultation', 'fichier_patient_id', 'teleconsultation_id');
    }
}
