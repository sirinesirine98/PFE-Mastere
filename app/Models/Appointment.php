<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Notifications\Notifiable;
use App\Models\Appointment;
use App\Models\DemandeurRdv;

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
        'doctor',
        'etat',
        'status',
    ];

    public function demandeurRdv()
    {
        return $this->hasOne(DemandeurRdv::class, 'rdv_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}