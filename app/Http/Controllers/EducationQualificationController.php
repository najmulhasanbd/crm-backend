<?php

namespace App\Http\Controllers;

use App\Models\EducationQualification;
use Illuminate\Http\Request;

class EducationQualificationController extends Controller
{
    protected $education;

    public function __construct(EducationQualification $education)
    {
        $this->education = $education;
    }

    public function index()
    {
        $educations = $this->education->latest()->paginate(10);
        return view('backend.education.index', compact('educations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:education_qualifications,name'
        ], [
            'name.unique' => 'This Education name already exists!',
        ]);

        $this->education->create([
            'name' => $request->name
        ]);

        return redirect()->back()->with([
            'message' => 'Education Created Successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, EducationQualification $education)
    {
        $request->validate([
            'name' => 'required|string|unique:education_qualifications,name,' . $education->id,
        ]);

        $education->update([
            'name' => $request->name,
        ]);

        return redirect()->route('education.index')->with([
            'message' => 'Education updated successfully!',
            'alert-type' => 'success',
        ]);
    }


    public function delete(EducationQualification $education)
    {
        $name = $education->name;

        $education->delete();

        return redirect()->route('education.index')->with([
            'message' => "Education '{$name}' deleted successfully!",
            'alert-type' => 'success'
        ]);
    }
}
