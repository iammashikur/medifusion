<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->hasOne(Patient::class, 'id', 'user_id');
    }

    public function getAgent(){
        return $this->hasOne(Agent::class, 'id', 'user_id');
    }

    public function getDoctor(){
        return $this->hasOne(Doctor::class, 'id', 'user_id');
    }

    public function getHospital(){
        return $this->hasOne(Hospital::class, 'id', 'user_id');
    }
}
