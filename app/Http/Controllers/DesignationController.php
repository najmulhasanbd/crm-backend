<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    protected $designation;

    public function __construct(Designation $designation)
    {
        $this->designation = $designation;
    }

    public function index()
    {
        $designation = $this->designation->latest()->get();
        return view('backend.designation.index', compact('designation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:designations,name'
        ], [
            'name.unique' => 'This Designation name already exists!',
        ]);

        $this->designation->create([
            'name' => $request->name
        ]);

        return redirect()->back()->with([
            'message' => 'Designation Created Successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name' => 'required|string|unique:designations,name,' . $designation->id,
        ]);

        $designation->update([
            'name' => $request->name,
        ]);

        return redirect()->route('designation.index')->with([
            'message' => 'Designation updated successfully!',
            'alert-type' => 'success',
        ]);
    }


    public function delete(Designation $designation)
    {
        $name = $designation->name;

        $designation->delete();

        return redirect()->route('designation.index')->with([
            'message' => "Designation '{$name}' deleted successfully!",
            'alert-type' => 'success'
        ]);
    }

}
