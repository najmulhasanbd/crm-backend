<?php

namespace App\Http\Controllers;

use App\Models\JobRole;
use Illuminate\Http\Request;

class JobRoleController extends Controller
{
    protected $jobRole;

    public function __construct(JobRole $jobRole)
    {
        $this->jobRole = $jobRole;
    }

    public function index()
    {
        $jobRoles = $this->jobRole->latest()->paginate(10);
        return view('backend.jobRole.index', compact('jobRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:job_roles,name'
        ], [
            'name.unique' => 'This Job Role name already exists!',
        ]);

        $this->jobRole->create([
            'name' => $request->name
        ]);

        return redirect()->back()->with([
            'message' => 'Job Role Created Successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, JobRole $jobRole)
    {
        $request->validate([
            'name' => 'required|string|unique:job_roles,name,' . $jobRole->id,
        ]);

        $jobRole->update([
            'name' => $request->name,
        ]);

        return redirect()->route('jobRole.index')->with([
            'message' => 'Job Role updated successfully!',
            'alert-type' => 'success',
        ]);
    }


    public function delete(JobRole $jobRole)
    {
        $name = $jobRole->name;

        $jobRole->delete();

        return redirect()->route('jobRole.index')->with([
            'message' => "Job Role '{$name}' deleted successfully!",
            'alert-type' => 'success'
        ]);
    }
}
