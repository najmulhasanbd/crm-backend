<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    protected $user;
    protected $department;
    protected $designation;

    public function __construct(User $user, Department $department, Designation $designation)
    {
        $this->user = $user;
        $this->department = $department;
        $this->designation = $designation;
    }

    public function index()
    {
        $users = $this->user->latest()->get();
        $designation = $this->designation::latest()->get();
        $department = $this->department::latest()->get();
        return view('backend.admin.index', compact('users', 'department', 'designation'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'id_card' => 'required|string|max:50|unique:users,id_card',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'blood' => 'nullable|string|max:3',
            'salary' => 'required|numeric|min:0',
            'commission' => 'nullable|numeric|min:0',
            'email' => 'required|email|unique:users,email',
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

        try {
            // Photo upload
            $filename = null;
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = $request->name . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/users'), $filename);
            }

            // Create User (employee)
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('12345678'), // default password
                'id_card' => $validated['id_card'],
                'photo' => $filename,
                'department' => $validated['department'],
                'designation' => $validated['designation'],
                'blood' => $validated['blood'],
                'salary' => $validated['salary'],
                'commission' => $validated['commission'] ?? 0,
                'mobile' => $validated['mobile'],
                'birth_date' => $validated['birth_date'],
                'appointment_date' => $validated['appointment_date'],
                'join_date' => $validated['join_date'],
                'address' => $validated['address'],
                'status' => 0,
            ]);

            return redirect()->back()->with('success', 'User created successfully! Default password: 12345678');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'id_card' => 'required|string|max:50|unique:users,id_card,' . $user->id,
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'blood' => 'nullable|string|max:3',
            'salary' => 'required|numeric|min:0',
            'commission' => 'nullable|numeric|min:0',
            'email' => 'required|email|unique:users,email,' . $user->id,
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

        $filename = $user->photo;

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                $oldPath = public_path('uploads/users/' . $user->photo);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                } else {
                    \Log::error("Old photo not found: " . $oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/users'), $filename);
        }

        $user->update([
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

        return redirect()->route('user.index')->with([
            'message' => 'User updated successfully!',
            'alert-type' => 'success',
        ]);
    }

    public function delete(User $user)
    {
        $name = $user->name;

        if ($user->photo) {
            $file_path = public_path('uploads/users/' . $user->photo);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $user->delete();

        return redirect()->route('user.index')->with([
            'message' => "Admin '{$name}' deleted successfully!",
            'alert-type' => 'success'
        ]);
    }

    public function show(User $user)
    {
        return view('backend.admin.show', compact('user'));
    }

    public function active(User $user)
    {
        $user->status = 1;
        $user->save();

        return redirect()->back()->with([
            'message' => "Admin '{$user->name}' is now Active.",
            'alert-type' => 'success',
        ]);
    }

    public function inactive(User $user)
    {
        $user->status = 0;
        $user->save();

        return redirect()->back()->with([
            'message' => "Admin '{$user->name}' is now Inactive.",
            'alert-type' => 'error',
        ]);
    }
}
