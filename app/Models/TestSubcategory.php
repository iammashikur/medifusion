<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubcategory extends Model
{
    use HasFactory;

    public function getParent(){
        return $this->hasOne(TestCategory::class, 'id', 'category_id');
    }
}
