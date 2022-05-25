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
}
