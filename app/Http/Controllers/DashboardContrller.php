<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Lead;

class DashboardContrller extends Controller
{
    public function index()
    {
        $leads = Lead::count();
        $departments = Department::count();
        $employees = Employee::count();
        return view('backend.index', compact('employees', 'leads', 'departments'));
    }
}
