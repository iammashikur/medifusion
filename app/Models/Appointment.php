<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function getDoctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function getPatient(){
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function getStatus(){
        return $this->hasOne(AppointmentStatus::class, 'id', 'status_id');
    }
}
