<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestPrice extends Model
{
    use HasFactory,SoftDeletes;

    public function getParent(){
        return $this->hasOne(TestSubcategory::class, 'id', 'test_id')->withTrashed();
    }

    public function getHospital(){
        return $this->hasOne(Hospital::class,  'id', 'hospital_id')->withTrashed();
    }



}
