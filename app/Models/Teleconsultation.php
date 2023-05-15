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
}

