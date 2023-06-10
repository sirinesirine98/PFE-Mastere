<?php
namespace App\Models;
use App\Models\Appointment;
use App\Models\DemandeurRdv;

use Illuminate\Database\Eloquent\Model;


    class DemandeurRdv extends Model
{
    protected $table = 'demandeur_rdv';

    protected $fillable = [
        'name_user',
        'email_user',
        'telephone_user',
        'nom_medecin',
        'date_rdv',
        'heure_rdv',
        'message',
        'etat',
        'rdv_id',
    ];


    public function appointment()
{
    return $this->belongsTo(Appointment::class, 'rdv_id');
}


       public function demandeurRdv()
    {
        return $this->hasOne(DemandeurRdv::class, 'rdv_id');
    }

    public function patient()
{
    return $this->hasOne(Patient::class, 'demandeur_id');
}

}
