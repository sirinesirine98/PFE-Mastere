<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;


public function teleconsultation()
{
return $this->belongsTo(Teleconsultations::class);
}


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

