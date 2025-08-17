<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Employee;
use Illuminate\Support\Facades\Artisan;
use App\Models\Department;

class DashboardContrller extends Controller
{

    public function clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return redirect()->back()->with([
            'message' => 'Cache cleared successfully!',
            'alert-type' => 'success',
        ]);
    }


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
        $data['missingLeadCount'] = Lead::whereNull('follow_up')->orWhere('follow_up', '[]')->count();
        $today = Carbon::today()->toDateString();

        $leads = Lead::whereNotNull('follow_up')->get();

        $todayFollow = $leads->filter(function ($lead) use ($today) {
            $followUps = json_decode($lead->follow_up, true);
            if (!$followUps || !is_array($followUps)) {
                return false;
            }

            $lastDate = end($followUps);
            return $lastDate === $today;
        });

        $data['todayFollowCount'] = $todayFollow->count();

        return view('backend.index', compact('data'));
    }
}
