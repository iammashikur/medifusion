<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentTest extends Model
{
    use HasFactory;
    public function Data(){
        return $this->hasOne(Agent::class, 'id', 'agent_id');
    }
}
