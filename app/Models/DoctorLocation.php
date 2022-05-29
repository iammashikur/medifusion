<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorLocation extends Model
{
    use HasFactory,SoftDeletes;

    public function getDoctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function getHospital(){
        return $this->hasOne(Hospital::class, 'id', 'hospital_id');
    }

    public function getDistrict(){
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function getThana(){
        return $this->hasOne(PoliceStation::class, 'id', 'thana_id');
    }
}
