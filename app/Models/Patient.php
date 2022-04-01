<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Model
{
    use HasApiTokens, HasFactory;


    public function getAgent(){
        return $this->hasOne(Agent::class, 'id', 'referred_by_id');
    }

    public function getTest(){
        return $this->hasMany(PatientTest::class, 'patient_id', 'id');
    }

    public function getAppointment(){
        return $this->hasMany(Appointment::class, 'patient_is', 'id');
    }

    public function getDistrict(){
        return $this->hasOne(District::class, 'id', 'district');
    }

    public function getThana(){
        return $this->hasOne(PoliceStation::class, 'id', 'thana');
    }



}
