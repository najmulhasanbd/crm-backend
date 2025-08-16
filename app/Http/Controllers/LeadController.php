<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\JobRole;
use App\Models\LeadAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EducationQualification;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->get();
        $assign = LeadAssign::with('lead', 'user')->get();

        $jobRoles = JobRole::latest()->get();
        $education = EducationQualification::latest()->get();
        return view('backend.lead.index', compact('jobRoles', 'education', 'leads', 'assign'));
    }

    public function create()
    {
        $jobRoles = JobRole::latest()->get();
        $education = EducationQualification::latest()->get();
        return view('backend.lead.create_lead', compact('jobRoles', 'education'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'client_type' => 'required|string|in:individual,agent',
                    'name' => 'required|string|max:255',
                    'passport' => ['required', 'string', 'unique:leads,passport', 'regex:/^[A-Za-z0-9]+$/'],
                    'mobile' => ['required', 'unique:leads,mobile'],
                    'whatsapp' => 'nullable|string',
                    'age' => 'required|numeric',
                    'country' => 'required|string',
                    'job_role' => 'required|string',
                    'experience' => 'required|string',
                    'follow_up' => 'required|date',
                    'education' => 'required|string',
                    'priority' => 'required|string|max:50',
                    'status' => 'required|string|max:50',
                    'source' => 'nullable|in:agent,facebook,youtube,google,whatsapp,instagram,tiktok,imo,referral,walk-in,digital_marketing',
                    'note' => 'nullable|string',
                ],
                [
                    'client_type.required' => 'Please select a lead type.',
                    'client_type.in' => 'Invalid lead type selected.',
                    'mobile.*' => ['required', 'distinct', 'regex:/^[0-9]+$/'], // প্রতিটা number চেক
                    'passport.unique' => 'This passport number already exists!',
                    'passport.regex' => 'Passport must contain only letters and numbers, no special characters.',
                ],
            );

            // Generate auto-increment Lead ID
            $lastLead = Lead::latest('id')->first();
            if ($lastLead) {
                $lastNumber = (int) str_replace('LD', '', $lastLead->lead_id);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1001; // start from LD1001
            }
            $leadId = 'LD' . $newNumber;

            // Create lead
            Lead::create([
                'lead_id' => $leadId,
                'client_type' => $request->input('client_type', 'individual'), // default 'individual'
                'company_name' => $request->company_name,
                'name' => $validated['name'],
                'passport' => $validated['passport'],
                'mobile' => json_encode($validated['mobile']),
                'whatsapp' => $validated['whatsapp'] ?? null,
                'age' => $validated['age'],
                'country' => $validated['country'],
                'job_role' => $validated['job_role'],
                'experience' => $validated['experience'],
                'follow_up' => json_encode([$validated['follow_up']]),
                'education' => $validated['education'],
                'priority' => $validated['priority'],
                'status' => $validated['status'],
                'source' => $validated['source'],
                'note' => $validated['note'] ?? null,
                'assign_user' => auth()->id(),
            ]);

            return redirect()->route('lead.index')->with([
                'message' => 'Lead created successfully! Lead ID: ' . $leadId,
                'alert-type' => 'success'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Database error: ' . $e->getMessage()]);
        }
    }
    public function edit(Lead $lead)
    {
        $jobRoles = JobRole::latest()->get();
        $education = EducationQualification::latest()->get();
        return view('backend.lead.edit_lead', compact('lead', 'jobRoles', 'education'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'client_type' => 'required|string|in:individual,agent',
            'name' => 'required|string|max:255',
            'passport' => ['required', 'string', 'unique:leads,passport,' . $lead->id, 'regex:/^[A-Za-z0-9]+$/'],
            'mobile' => ['required', 'array'],
            'mobile.*' => ['required', 'distinct', 'regex:/^[0-9]+$/'],
            'whatsapp' => 'nullable|string',
            'age' => 'required|numeric',
            'country' => 'required|string',
            'job_role' => 'required|string',
            'experience' => 'required|string',
            'follow_up' => 'required|date',
            'education' => 'required|string',
            'priority' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'source' => 'nullable|in:agent,facebook,youtube,google,whatsapp,instagram,tiktok,imo,referral,walk-in,digital_marketing',
            'company_name' => 'nullable|string',
            'note' => 'nullable|string',
        ], [
            'client_type.required' => 'Please select a lead type.',
            'client_type.in' => 'Invalid lead type selected.',
            'passport.unique' => 'This passport number already exists!',
            'passport.regex' => 'Passport must contain only letters and numbers, no special characters.',
            'mobile.*.required' => 'Mobile number is required.',
            'mobile.*.distinct' => 'Duplicate mobile numbers are not allowed.',
            'mobile.*.regex' => 'Mobile must contain only numbers.',
        ]);

        // Follow-up history
        $history = is_array(json_decode($lead->follow_up, true)) ? json_decode($lead->follow_up, true) : [];
        if (!in_array($validated['follow_up'], $history)) {
            $history[] = $validated['follow_up'];
        }

        // Update lead
        $lead->update([
            'client_type' => $validated['client_type'],
            'company_name' => $validated['company_name'] ?? null,
            'name' => $validated['name'],
            'passport' => $validated['passport'],
            'mobile' => json_encode($validated['mobile']),
            'whatsapp' => $validated['whatsapp'] ?? null,
            'age' => $validated['age'],
            'country' => $validated['country'],
            'job_role' => $validated['job_role'],
            'experience' => $validated['experience'],
            'follow_up' => json_encode($history),
            'education' => $validated['education'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'source' => $validated['source'] ?? null,
            'note' => $validated['note'] ?? null,
            'assign_user' => auth()->id(),
        ]);

        return redirect()->route('lead.index')->with([
            'message' => 'Lead updated successfully!',
            'alert-type' => 'success'
        ]);
    }


    public function show(Lead $lead)
    {
        $lead->load('assignedEmployees');
        $jobRoles = JobRole::latest()->get();
        $education = EducationQualification::latest()->get();

        return view('backend.lead.show', compact('lead', 'jobRoles', 'education'));
    }

    public function booked()
    {
        $booked = Lead::where('status', 'booked')->latest()->get();
        return view('backend.lead.booked', compact('booked'));
    }
    public function droped()
    {
        $droped = Lead::where('status', 'droped')->latest()->get();
        return view('backend.lead.droped', compact('droped'));
    }
    public function onprocess()
    {
        $onprocess = Lead::where('status', 'onprocess')->latest()->get();
        return view('backend.lead.onprocess', compact('onprocess'));
    }
    public function converted()
    {
        $converted = Lead::where('status', 'converted')->latest()->get();
        return view('backend.lead.converted', compact('converted'));
    }
}
