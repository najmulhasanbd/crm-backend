@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Edit Role: {{ $role->name }}</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li>
                            <a href="{{ route('user.roles') }}">
                                <i class="ph-duotone ph-table"></i> Role List
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0)">Edit</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Edit Role</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.role.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Role Name -->
                                <div class="mb-3">
                                    <label class="form-label">Role Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                                </div>

                                <!-- Select All -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                    <label class="form-check-label fw-bold" for="select-all">
                                        All Permissions
                                    </label>
                                </div>
                                <hr>

                                <!-- Permission Groups -->
                                @foreach ($permissions as $groupName => $groupPermissions)
                                    <div class="mb-3">
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox"
                                                id="{{ Str::slug($groupName) }}-group">
                                            <label class="form-check-label fw-bold"
                                                for="{{ Str::slug($groupName) }}-group">{{ $groupName }}</label>
                                        </div>

                                        <div class="ms-4">
                                            @foreach ($groupPermissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="{{ Str::slug($permission->name) }}"
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="{{ Str::slug($permission->name) }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-success">Update Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allPermissions = document.querySelectorAll('.ms-4 input[type="checkbox"]');
            const selectAll = document.getElementById('select-all');

            // Function to update group checkboxes
            function updateGroupCheckboxes() {
                document.querySelectorAll('[id$="-group"]').forEach(group => {
                    const groupWrapper = group.closest('.mb-3');
                    const groupCheckboxes = groupWrapper.querySelectorAll('.ms-4 input[type="checkbox"]');
                    group.checked = Array.from(groupCheckboxes).every(cb => cb.checked);
                });
            }

            // Function to update select-all checkbox
            function updateSelectAll() {
                selectAll.checked = Array.from(allPermissions).every(cb => cb.checked);
            }

            // Initial check on page load
            updateGroupCheckboxes();
            updateSelectAll();

            // Group wise select/deselect
            document.querySelectorAll('[id$="-group"]').forEach(group => {
                group.addEventListener('change', function() {
                    const groupWrapper = this.closest('.mb-3');
                    const groupCheckboxes = groupWrapper.querySelectorAll(
                        '.ms-4 input[type="checkbox"]');
                    groupCheckboxes.forEach(cb => cb.checked = this.checked);
                    updateSelectAll();
                });
            });

            // Individual permission change
            allPermissions.forEach(cb => {
                cb.addEventListener('change', function() {
                    updateGroupCheckboxes();
                    updateSelectAll();
                });
            });

            // Select All toggle
            selectAll.addEventListener('change', function() {
                allPermissions.forEach(cb => cb.checked = this.checked);
                document.querySelectorAll('[id$="-group"]').forEach(group => group.checked = this.checked);
            });
        });
    </script>

@endsection
