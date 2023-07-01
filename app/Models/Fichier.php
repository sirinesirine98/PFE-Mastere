<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
        protected $fillable = ['date', 'roomId', 'dateconsultation', 'fichierpartager', 'libre'];


}
