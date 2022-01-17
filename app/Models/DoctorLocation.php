<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorLocation extends Model
{
    use HasFactory;

    public function getLocation(){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
}
