<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


   
class Admin extends Model
{
    protected $primaryKey = 'admin_id';

    public function teleconsultations()
    {
        return $this->hasMany(Teleconsultation::class, 'admin_id');
    }

     public function doctors()
    {
        return $this->hasMany(Doctor::class, 'admin_id');
    }
}

