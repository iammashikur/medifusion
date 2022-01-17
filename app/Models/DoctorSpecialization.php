<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    use HasFactory;
    public function getDoctors(){
        return $this->hasMany(Doctor::class, 'specialization', 'id');
    }
}
