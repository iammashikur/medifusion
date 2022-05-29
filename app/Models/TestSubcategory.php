<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestSubcategory extends Model
{
    use HasFactory,SoftDeletes;

    public function getParent(){
        return $this->hasOne(TestCategory::class, 'id', 'category_id');
    }

    public function getHospital(){
        return $this->hasOne(Hospital::class,  'id', 'hospital_id');
    }

    public function getPrice(){
        return $this->hasMany(TestPrice::class,  'test_id', 'id');
    }
}
