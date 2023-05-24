<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsPartages extends Model
{

    public function teleconsultations()
    {
        return $this->belongsToMany(Teleconsultation::class, 'documents_partages_teleconsultation', 'documents_partages_id', 'teleconsultation_id');
    }
}
