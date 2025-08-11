<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employee;
    protected $department;
    protected $designation;

    public function __construct(Employee $employee, Department $department, Designation $designation)
    {
        $this->employee = $employee;
        $this->department = $department;
        $this->designation = $designation;
    }

    public function index()
    {
        $employee = $this->employee->latest()->paginate(10);
        $designation = $this->designation::latest()->get();
        $department = $this->department::latest()->get();
        return view('backend.employee.index', compact('employee', 'department', 'designation'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'id_card' => 'required|string|max:50|unique:employees,id_card',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'blood' => 'nullable|string|max:3',
            'salary' => 'required|numeric|min:0',
            'commission' => 'nullable|numeric|min:0',
            'email' => 'required|email|unique:employees,email',
            'mobile' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'appointment_date' => 'required|date',
            'join_date' => 'required|date',
            'address' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'id_card.unique' => 'This ID Card already exists!',
            'email.unique' => 'This Email already exists!',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $request->name . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $file->move(public_path('uploads/employees'), $filename);
        } else {
            $filename = null;
        }
        Employee::create([
            'id_card'          => $request->id_card,
            'name'             => $request->name,
            'department'       => $request->department,
            'designation'      => $request->designation,
            'blood'            => $request->blood,
            'salary'           => $request->salary,
            'commission'       => $request->commission ?? 0,
            'email'            => $request->email,
            'mobile'           => $request->mobile,
            'birth_date'       => $request->birth_date,
            'appointment_date' => $request->appointment_date,
            'join_date'        => $request->join_date,
            'address'          => $request->address,
            'status'           => 0,
            'photo'            => $filename,
        ]);

        return redirect()->back()->with([
            'message' => 'Employee Created Successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'id_card' => 'required|string|max:50|unique:employees,id_card,' . $employee->id,
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'blood' => 'nullable|string|max:3',
            'salary' => 'required|numeric|min:0',
            'commission' => 'nullable|numeric|min:0',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'appointment_date' => 'required|date',
            'join_date' => 'required|date',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'id_card.unique' => 'This ID Card already exists!',
            'email.unique' => 'This Email already exists!',
        ]);

        $filename = $employee->photo;

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                $oldPath = public_path('uploads/employees/' . $employee->photo);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                } else {
                    \Log::error("Old photo not found: " . $oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/employees'), $filename);
        }

        $employee->update([
            'id_card' => $request->id_card,
            'name' => $request->name,
            'department' => $request->department,
            'designation' => $request->designation,
            'blood' => $request->blood,
            'salary' => $request->salary,
            'commission' => $request->commission ?? 0,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'birth_date' => $request->birth_date,
            'appointment_date' => $request->appointment_date,
            'join_date' => $request->join_date,
            'address' => $request->address,
            'photo' => $filename,
        ]);

        return redirect()->route('employee.index')->with([
            'message' => 'Employee updated successfully!',
            'alert-type' => 'success',
        ]);
    }

    public function delete(Employee $employee)
    {
        $name = $employee->name;

        if ($employee->photo) {
            $file_path = public_path('uploads/employees/' . $employee->photo);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $employee->delete();

        return redirect()->route('employee.index')->with([
            'message' => "Employee '{$name}' deleted successfully!",
            'alert-type' => 'success'
        ]);
    }

    public function show(Employee $employee)
    {
        return view('backend.employee.show', compact('employee'));
    }

    public function active(Employee $employee)
    {
        $employee->status = 1;
        $employee->save();

        return redirect()->back()->with([
            'message' => "Employee '{$employee->name}' is now Active.",
            'alert-type' => 'success',
        ]);
    }

    public function inactive(Employee $employee)
    {
        $employee->status = 0;
        $employee->save();

        return redirect()->back()->with([
            'message' => "Employee '{$employee->name}' is now Inactive.",
            'alert-type' => 'success',
        ]);
    }
}
