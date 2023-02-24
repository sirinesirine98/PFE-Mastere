<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    #si notre id n'est pas auto incrément on doit ajouter cette ligne :  public $incrementing = false;
}





