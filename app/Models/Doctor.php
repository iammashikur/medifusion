<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $hidden = ['password'];

    use HasFactory;

    public function getSpecialization(){
        return $this->hasOne(DoctorSpecialization::class, 'id', 'specialization');
    }



}
