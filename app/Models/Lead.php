<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'assign_user');
    }

 public function leadassign()
    {
        return $this->belongsTo(leadassign::class);
    }
}
