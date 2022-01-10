<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPrice extends Model
{
    use HasFactory;

    public function getParent(){
        return $this->hasOne(TestSubcategory::class, 'id', 'test_id');
    }

    public function getHospital(){
        return $this->hasOne(Hospital::class,  'id', 'hospital_id');
    }



}
