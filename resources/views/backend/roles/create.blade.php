@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">

            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Admin Role Create</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li>
                            <a class="f-s-14 f-w-500" href="{{ route('user.roles') }}">
                                <i class="ph-duotone ph-table f-s-16"></i> Role List
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Create</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    <div class="list-table-header d-flex justify-content-sm-between mb-3">
                        <a href="{{ route('user.roles') }}" class="btn btn-primary">Role List</a>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb end -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="text-white mb-0">Admin Role Create</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.role.store') }}" method="POST">
                                @csrf

                                <!-- Role Name -->
                                <div class="mb-3">
                                    <label class="form-label">Role Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>

                                <!-- All Permissions -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                    <label class="form-check-label fw-bold" for="select-all">
                                        All Permission
                                    </label>
                                </div>

                                <hr>

                                @foreach ($permissions as $groupName => $groupPermissions)
                                    <div class="mb-3">
                                        <!-- Group Title -->
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox"
                                                id="{{ Str::slug($groupName) }}-group">
                                            <label class="form-check-label fw-bold"
                                                for="{{ Str::slug($groupName) }}-group">{{ $groupName }}</label>
                                        </div>

                                        <!-- Group Permissions -->
                                        <div class="ms-4">
                                            @foreach ($groupPermissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="{{ Str::slug($permission->name) }}">
                                                    <label class="form-check-label"
                                                        for="{{ Str::slug($permission->name) }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // All Permission select/deselect
            document.getElementById('select-all').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });

            // Group wise select/deselect
            document.querySelectorAll('[id$="-group"]').forEach(group => {
                group.addEventListener('change', function() {
                    const groupWrapper = this.closest('.mb-3'); // parent container
                    const groupCheckboxes = groupWrapper.querySelectorAll(
                        '.ms-4 input[type="checkbox"]');
                    groupCheckboxes.forEach(cb => cb.checked = this.checked);
                });
            });
        });
    </script>
@endsection
