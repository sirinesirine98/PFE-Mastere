<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteRendu extends Model
{

    public function teleconsultation()
    {
        return $this->belongsTo(Teleconsultation::class);
    }

  
}

