<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function leadassign()
    {
        return $this->belongsTo(leadassign::class);
    }
}
