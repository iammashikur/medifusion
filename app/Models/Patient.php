<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Model
{
    use HasApiTokens, HasFactory;
    public function getAgent(){
        return $this->hasOne(Agent::class, 'id', 'referred_by_id');
    }
}
