<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\DepartmentExport;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentController extends Controller
{
    protected $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function index()
    {
        $department = $this->department->latest()->get();
        return view('backend.department.index', compact('department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:departments,name'
        ], [
            'name.unique' => 'This Department name already exists!',
        ]);

        $this->department->create([
            'name' => $request->name
        ]);

        return redirect()->back()->with([
            'message' => 'Department Created Successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|unique:departments,name,' . $department->id,
        ]);

        $department->update([
            'name' => $request->name,
        ]);

        return redirect()->route('department.index')->with([
            'message' => 'Department updated successfully!',
            'alert-type' => 'success',
        ]);
    }


    public function delete(Department $department)
    {
        $name = $department->name;

        $department->delete();

        return redirect()->route('department.index')->with([
            'message' => "Department '{$name}' deleted successfully!",
            'alert-type' => 'success'
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new DepartmentExport, 'departments.xlsx');
    }

    public function exportPDF()
    {
        $departments = Department::all();
        $pdf = Pdf::loadView('backend.department.pdf', compact('departments'));
        return $pdf->download('departments.pdf');
    }
}
