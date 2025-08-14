<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadAssign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadAssignController extends Controller
{
    protected $lead;
    protected $user;
    protected $leadassign;

    public function __construct(Lead $lead, User $user, LeadAssign $leadassign)
    {
        $this->user = $user;
        $this->lead = $lead;
    }

    public function index()
    {
        $lead = $this->lead->latest()->get();
        $user = $this->user->where('status', 1)->get();
        $assign = LeadAssign::with('lead', 'user')->latest()->get();
        return view('backend.lead.assignlead', compact('lead', 'user', 'assign'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lead_id'     => 'required|exists:leads,id',
        ]);

        $exists = DB::table('lead_assigns')
            ->where('user_id', $request->user_id)
            ->where('lead_id', $request->lead_id)
            ->exists();

        if ($exists) {
            return back()->with([
                'message' => 'This lead is already assigned to this user!',
                'alert-type' => 'error'
            ]);
        }

        DB::table('lead_assigns')->insert([
            'user_id' => $request->user_id,
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
        'user_id' => 'required|exists:users,id',
        'lead_id'     => 'required|exists:leads,id',
    ]);

    // Prevent duplicate user-lead pair
    $exists = LeadAssign::where('user_id', $request->user_id)
        ->where('lead_id', $request->lead_id)
        ->where('id', '!=', $leadAssign->id)
        ->exists();

    if ($exists) {
        return back()->with([
            'message' => 'This lead is already assigned to this user!',
            'alert-type' => 'error'
        ])->withInput();
    }

    $leadAssign->update([
        'user_id' => $request->user_id,
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
