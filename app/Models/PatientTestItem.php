<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTestItem extends Model
{
    use HasFactory;

    public function getTest(){
        return $this->hasOne(TestSubcategory::class, 'id', 'test_id');
    }

}
