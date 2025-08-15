@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">

            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Admin Role List </h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a class="f-s-14 f-w-500" href="{{ route('education.index') }}">
                                <span>
                                    <i class="ph-duotone  ph-table f-s-16"></i> Admin Role List
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Admin Role List</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    <div class="list-table-header d-flex justify-content-sm-between mb-3">
                        <a href="{{ route('user.role.create') }}" class="btn btn-primary">Role Create</a>
                    </div>
                </div>
            </div>

            <!-- Breadcrumb end -->

            <div class="row">
                <!-- List Js Table start -->
                <div class="col-12">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="app-datatable-default overflow-auto">
                                <table class="display w-100 row-border-table table-responsive" id="example1">
                                    <thead>
                                        <tr class="app-sort">
                                            <th>ID</th>
                                            <th class="sort">Role Name</th>
                                            <th class="sort">Permission</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="t-data">
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ ucwords($role->name) }}</td>
                                                <td>
                                                    @if ($role->permissions->count())
                                                        @foreach ($role->permissions as $perm)
                                                            <span class="badge bg-info">{{ $perm->name }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-secondary">No Permissions</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.role.edit', $role->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('user.role.delete', $role->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
            });
        });
    </script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
@endsection
