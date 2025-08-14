@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Assign Lead</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a class="f-s-14 f-w-500" href="{{ route('department.index') }}">
                                <span>
                                    <i class="ph-duotone  ph-table f-s-16"></i> Assign Lead
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Assign Lead</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    <div class="list-table-header d-flex justify-content-sm-between mb-3">
                        <button class="btn btn-primary" data-bs-target="#exampleModal" data-bs-toggle="modal"
                            type="button">Add
                        </button>
                        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal"
                            tabindex="-1">
                            <form id="add_employee_form" method="POST" action="{{ route('lead-assign.store') }}">
                                @csrf
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Lead Assign
                                            </h1>
                                            <button aria-label="Close" class="btn-close m-0" data-bs-dismiss="modal"
                                                type="button"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="user_id">Employee</label>
                                                <select name="user_id" id="user_id" class="form-select">
                                                    <option value="">Select Employee</option>
                                                    @foreach ($user as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ ucwords($item->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="lead_id">Lead</label>
                                                <select name="lead_id" id="lead_id" class="form-select">
                                                    <option value="">Select Lead</option>
                                                    @foreach ($lead as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ ucwords($item->lead_id) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer add">
                                            <input class="btn btn-secondary" data-bs-dismiss="modal" type="button"
                                                value="Close">
                                            <input class="btn btn-primary" id="add-btn" type="submit" value="Add">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                            <th class="">ID</th>
                                            <th class="sort">Employee</th>
                                            <th class="sort">Lead</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="t-data">
                                        @foreach ($assign as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ ucwords($item->user->name) }}</td>
                                                <td>{{ ucwords($item->lead->lead_id) }}</td>

                                                <td class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->id }}">
                                                        <i class="ph-duotone ph-pencil f-s-16"></i>
                                                    </button>
                                                    <form action="{{ route('lead-assign.delete', $item->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="ph-duotone ph-trash f-s-16"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal for THIS item -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('lead-assign.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $item->id }}">Update Lead
                                                                    Assign</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group mb-3">
                                                                    <label
                                                                        for="user_id_{{ $item->id }}">Employee</label>
                                                                    <select name="user_id"
                                                                        id="user_id_{{ $item->id }}"
                                                                        class="form-select">
                                                                        <option value="">Select Employee</option>
                                                                        @foreach ($user as $emp)
                                                                            <option value="{{ $emp->id }}"
                                                                                {{ $item->user_id == $emp->id ? 'selected' : '' }}>
                                                                                {{ ucwords($emp->name) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label for="lead_id_{{ $item->id }}">Lead</label>
                                                                    <select name="lead_id"
                                                                        id="lead_id_{{ $item->id }}"
                                                                        class="form-select">
                                                                        <option value="">Select Lead</option>
                                                                        @foreach ($lead as $ld)
                                                                            <option value="{{ $ld->id }}"
                                                                                {{ $item->lead_id == $ld->id ? 'selected' : '' }}>
                                                                                {{ ucwords($ld->lead_id) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Assign</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
@endsection
