<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\JobRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EducationQualification;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->get();
        $jobRoles = JobRole::latest()->get();
        $education = EducationQualification::latest()->get();
        return view('backend.lead.index', compact('jobRoles', 'education', 'leads'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'lead_id' => 'required|string|max:50|unique:leads,lead_id',
                'name'        => 'required|string|max:255',
                'passport'    => 'required|string|unique:leads,passport',
                'mobile'      => 'required|string|unique:leads,mobile',
                'whatsapp'    => 'nullable|string',
                'age'         => 'required|numeric',
                'country'     => 'required|string',
                'job_role'    => 'required|string',
                'experience'  => 'required|string',
                'follow_up'   => 'required|date',
                'education'   => 'required|string',
                'priority'    => 'required|string|max:50',
                'status'      => 'required|string|max:50',
                'note'        => 'nullable|string',
            ], [
                'passport.unique' => 'This passport number already exists!',
                'mobile.unique'   => 'This mobile number already exists!',
                'lead_id.unique'  => 'This Lead ID already exists!',
            ]);

            $leadId = 'LD' . $validated['lead_id'];

            Lead::create([
                'lead_id'     => $leadId,
                'name'        => $validated['name'],
                'passport'    => $validated['passport'],
                'mobile'      => $validated['mobile'],
                'whatsapp'    => $validated['whatsapp'] ?? null,
                'age'         => $validated['age'],
                'country'     => $validated['country'],
                'job_role'    => $validated['job_role'],
                'experience'  => $validated['experience'],
                'follow_up'   => json_encode([$validated['follow_up']]),
                'education'   => $validated['education'],
                'priority'    => $validated['priority'],
                'status'      => $validated['status'],
                'note'        => $validated['note'] ?? null,
                'assign_user' => Auth::id(),
            ]);

            return redirect()->route('lead.index')->with('success', 'Lead created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            // Fetch last Lead number
            $lastLead = Lead::latest('id')->first();
            $lastNumber = $lastLead ? str_replace('LD', '', $lastLead->lead_id) : 'none';

            return redirect()->back()->withInput()->withErrors([
                'lead_id' => "Lead ID already exists. Last Lead number in DataBase is LD{$lastNumber}. Please choose another ID."
            ]);
        }
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport' => 'required|string|unique:leads,passport,' . $lead->id,
            'mobile' => 'required|string|unique:leads,mobile,' . $lead->id,
            'whatsapp' => 'nullable|string',
            'age' => 'required|numeric',
            'country' => 'required|string',
            'job_role' => 'required|string',
            'experience' => 'required|string',
            'follow_up' => 'required|date',
            'education' => 'required|string',
            'priority' => 'required|string',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        // Follow-up history
        $history = is_array(json_decode($lead->follow_up, true))
            ? json_decode($lead->follow_up, true)
            : [];

        if (!in_array($validated['follow_up'], $history)) {
            $history[] = $validated['follow_up'];
        }

        // Update
        $lead->update([
            'name' => $validated['name'],
            'passport' => $validated['passport'],
            'mobile' => $validated['mobile'],
            'whatsapp' => $validated['whatsapp'] ?? null,
            'age' => $validated['age'],
            'country' => $validated['country'],
            'job_role' => $validated['job_role'],
            'experience' => $validated['experience'],
            'follow_up' => json_encode($history),
            'education' => $validated['education'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'note' => $validated['note'] ?? null,
            'assign_user' => Auth::id(),
        ]);

        return redirect()->route('lead.index')->with([
            'message' => "Lead updated successfully!",
            'alert-type' => 'success'
        ]);
    }


    public function show(Lead $lead)
    {
        $lead->load('user'); // or use the line above
        $jobRoles = JobRole::latest()->get();
        $education = EducationQualification::latest()->get();

        return view('backend.lead.show', compact('lead', 'jobRoles', 'education'));
    }
}
