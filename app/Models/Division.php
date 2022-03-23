<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;
    protected $table = 'bdlocation_divisions';

    public function districts()
    {
        return $this->hasMany(District::class );
    }
}
