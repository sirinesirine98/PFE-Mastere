<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;


public function rooms()
{
return $this->hasMany(Room::class);
}

 public function documents()
    {
        return $this->hasMany(Document::class);
    }

      public function compterendus()
    {
        return $this->hasMany(CompteRendu::class);
    }
      public function documentspartagers()
    {
        return $this->hasMany(DocumentPargater::class);
    }
     public function fichierpatient()
    {
        return $this->hasOne(FichierPatient::class);
    }

 
     protected $primaryKey = 'id_teleconsultation';

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}

