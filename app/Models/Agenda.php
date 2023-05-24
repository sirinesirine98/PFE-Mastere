<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



    class Agenda extends Model
{
    
 public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

 public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
}


