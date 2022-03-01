<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorLocation extends Model
{
    use HasFactory;

    public function getDoctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function getHospital(){
        return $this->hasOne(Hospital::class, 'id', 'hospital_id');
    }
}
