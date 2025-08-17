<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EducationQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $roles = Role::latest()->get();
        $users = $this->user->latest()->get();
        $designation = $this->designation::latest()->get();
        $department = $this->department::latest()->get();
        return view('backend.admin.index', compact('users', 'department', 'designation', 'roles'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'id_card' => 'required|string|max:50|unique:users,id_card',
            'name' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
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

            // Create User
            $user = User::create([
                'name' => $validated['name'],
                'role_id' => $validated['role_id'],
                'email' => $validated['email'],
                'password' => Hash::make('12345678'),
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

            // Assign Role & Sync Permissions
            $role = Role::findById($validated['role_id']);
            if ($role) {
                $user->assignRole($role);                   // role assign
                $user->syncPermissions($role->permissions); // role permissions sync
            }

            return redirect()->back()->with('success', 'User created successfully! Default password: 12345678');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function update(Request $request, User $user)
    {


        // Validation
        $request->validate([
            'id_card' => 'required|string|max:50|unique:users,id_card,' . $user->id,
            'name' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
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

        // Photo upload
        $filename = $user->photo;
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                $oldPath = public_path('uploads/users/' . $user->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                } else {
                    \Log::error('Old photo not found: ' . $oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/users'), $filename);
        }

        // Update User
        $user->update([
            'id_card' => $request->id_card,
            'name' => $request->name,
            'role_id' => $request->role_id,
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

        // Assign Role & Sync Permissions
        $role = Role::findById($request->role_id);
        if ($role) {
            $user->syncRoles($role);                   // model_has_roles update
            $user->syncPermissions($role->permissions); // model_has_permissions update
        }

        return redirect()
            ->route('user.index')
            ->with([
                'message' => 'User updated successfully and role & permissions synced!',
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

        return redirect()
            ->route('user.index')
            ->with([
                'message' => "Admin '{$name}' deleted successfully!",
                'alert-type' => 'success',
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

        return redirect()
            ->back()
            ->with([
                'message' => "Admin '{$user->name}' is now Active.",
                'alert-type' => 'success',
            ]);
    }

    public function inactive(User $user)
    {
        $user->status = 0;
        $user->save();

        return redirect()
            ->back()
            ->with([
                'message' => "Admin '{$user->name}' is now Inactive.",
                'alert-type' => 'error',
            ]);
    }

    public function adminRoles()
    {
        $roles = Role::with('permissions')->get();
        return view('backend.roles.index', compact('roles'));
    }

    public function adminRoleCreate()
    {
        $permissions = Permission::all()->groupBy('group_name');
        return view('backend.roles.create', compact('permissions'));
    }
    public function adminRoleStore(Request $request)
    {
        // Validation with custom message
        $request->validate(
            [
                'name' => 'required|string|unique:roles,name',
                'permissions' => 'required|array|min:1',
            ],
            [
                'name.unique' => 'Already stored this role', // custom message for duplicate role
                'name.required' => 'Role name is required',
                'permissions.required' => 'Please select at least one permission',
            ],
        );

        // Create Role
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web', // default guard
        ]);

        // Assign Permissions to Role
        $role->syncPermissions($request->permissions);

        // Success message and redirect
        return redirect()
            ->route('user.roles')
            ->with([
                'message' => 'Role created successfully!',
                'alert-type' => 'success',
            ]);
    }
    public function adminRoleEdit($id)
    {
        $role = Role::findOrFail($id); // get role
        $permissions = Permission::all()->groupBy('group_name'); // grouped permissions
        $rolePermissions = $role->permissions->pluck('name')->toArray(); // assigned permissions

        return view('backend.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function adminRoleUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'required|array|min:1',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        // sync permissions
        $role->syncPermissions($request->permissions);

        return redirect()
            ->route('user.roles')
            ->with([
                'message' => 'Role updated successfully!',
                'alert-type' => 'success',
            ]);
    }

    // Delete Role
    public function adminRoleDelete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()
            ->route('user.roles')
            ->with([
                'message' => 'Role deleted successfully!',
                'alert-type' => 'success',
            ]);
    }
}
