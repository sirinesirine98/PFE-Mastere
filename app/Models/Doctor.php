<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'speciality'];

    public function agenda()
    {
        return $this->hasOne(Agenda::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
