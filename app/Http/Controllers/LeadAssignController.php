<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Employee;
use App\Models\LeadAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadAssignController extends Controller
{
    protected $lead;
    protected $employee;
    protected $leadassign;

    public function __construct(Lead $lead, Employee $employee, LeadAssign $leadassign)
    {
        $this->employee = $employee;
        $this->lead = $lead;
    }

    public function index()
    {
        $lead = $this->lead->latest()->get();
        $employee = $this->employee->where('status', 1)->get();
        $assign = LeadAssign::with('lead', 'employee')->latest()->get();
        return view('backend.lead.assignlead', compact('lead', 'employee', 'assign'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'lead_id'     => 'required|exists:leads,id',
        ]);

        $exists = DB::table('lead_assigns')
            ->where('employee_id', $request->employee_id)
            ->where('lead_id', $request->lead_id)
            ->exists();

        if ($exists) {
            return back()->with([
                'message' => 'This lead is already assigned to this employee!',
                'alert-type' => 'error'
            ]);
        }

        DB::table('lead_assigns')->insert([
            'employee_id' => $request->employee_id,
            'lead_id'     => $request->lead_id,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with([
            'message' => 'Lead assigned successfully!',
            'alert-type' => 'success'
        ]);
    }

  public function update(Request $request, $id)
{
    $leadAssign = LeadAssign::findOrFail($id);

    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'lead_id'     => 'required|exists:leads,id',
    ]);

    // Prevent duplicate employee-lead pair
    $exists = LeadAssign::where('employee_id', $request->employee_id)
        ->where('lead_id', $request->lead_id)
        ->where('id', '!=', $leadAssign->id)
        ->exists();

    if ($exists) {
        return back()->with([
            'message' => 'This lead is already assigned to this employee!',
            'alert-type' => 'error'
        ])->withInput();
    }

    $leadAssign->update([
        'employee_id' => $request->employee_id,
        'lead_id'     => $request->lead_id,
    ]);

    return back()->with([
        'message' => 'Lead assignment updated successfully!',
        'alert-type' => 'success'
    ]);
}


    public function delete(LeadAssign $leadassign)
    {
        $leadassign->delete();

        return redirect()->route('lead-assign.index')->with([
            'message' => "Assign Lead deleted successfully!",
            'alert-type' => 'success'
        ]);
    }
}
