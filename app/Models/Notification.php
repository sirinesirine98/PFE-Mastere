<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



    class Notification extends Model
{
    

  public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
}


