<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compounder extends Model
{
    use HasFactory;

    public function getDoctors(){
        return $this->hasMany(CompounderDoctor::class, 'compounder_id', 'id');
    }
    public function getHospitals(){
        return $this->hasMany(CompounderHospital::class, 'compounder_id', 'id');
    }
}
