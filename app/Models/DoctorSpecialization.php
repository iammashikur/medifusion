<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSpecialization extends Model
{
    use HasFactory,SoftDeletes;
    public function getDoctors(){
        return $this->hasMany(Doctor::class, 'specialization', 'id')->withTrashed();
    }
}
