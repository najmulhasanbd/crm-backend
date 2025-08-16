<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Lead;

class DashboardContrller extends Controller
{
    public function index()
    {
        $employees = Employee::count();
        $leads = Lead::count();
        $booked = Lead::where('status','booked')->count();
        $onprocess = Lead::where('status','On Process')->count();
        $converted = Lead::where('status','converted')->count();
        $droped = Lead::where('status','Droped')->count();
        $departments = Department::count();
        return view('backend.index', compact('employees', 'leads', 'departments','booked','onprocess','converted','droped'));
    }
}
