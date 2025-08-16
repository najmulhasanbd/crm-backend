<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Lead;

class DashboardContrller extends Controller
{
    public function index()
    {
        $data = [];

        $data['employees'] = Employee::count();
        $data['leads'] = Lead::count();
        $data['booked'] = Lead::where('status', 'booked')->count();
        $data['onprocess'] = Lead::where('status', 'On Process')->count();
        $data['converted'] = Lead::where('status', 'converted')->count();
        $data['droped'] = Lead::where('status', 'Droped')->count();
        $data['rejected'] = Lead::where('status', 'Rejected')->count();
        $data['departments'] = Department::count();

        return view('backend.index', compact('data'));
    }
}
