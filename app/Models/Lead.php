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
    // Lead.php
    public function assignedEmployees()
    {
        return $this->belongsToMany(Employee::class, 'lead_assigns', 'lead_id', 'employee_id');
    }

    public function leadassign()
    {
        return $this->belongsTo(leadassign::class);
    }
}
