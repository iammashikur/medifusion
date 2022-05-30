<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    use HasFactory;

    public function getPatient(){
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
    public function getItems(){
        return $this->hasMany(PatientTestItem::class, 'patient_test_id', 'id');
    }
    public function getAgent(){

        return $this->hasOne(AgentTest::class, 'test_id', 'id')->with('Data');
    }

    public function getStatus(){
        return $this->hasOne(PatientTestStatus::class, 'id', 'status_id');
    }


}
