<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Notifications\Notifiable;


class Appointment extends Model
{
    use HasFactory;

    use Notifiable;

     protected $fillable = [
    'name',
    'email',
    'phone',
    'date',
    'message',
];
}