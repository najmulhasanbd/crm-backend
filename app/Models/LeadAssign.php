<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadAssign extends Model
{
     protected $guarded = [];

     public function employee()
     {
          return $this->belongsTo(Employee::class);
     }
     public function lead()
     {
          return $this->belongsTo(Lead::class);
     }
}
