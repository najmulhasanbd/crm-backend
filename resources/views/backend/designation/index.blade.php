@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">

            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Designation List </h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a class="f-s-14 f-w-500" href="{{ route('designation.index') }}">
                                <span>
                                    <i class="ph-duotone  ph-table f-s-16"></i> Designation List
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Designation List</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Breadcrumb end -->

            <div class="row">
                <!-- List Js Table start -->
                <div class="col-xxl-8">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <div class="card equal-card ">
                        <div class="card-body p-0">
                            <div id="myTable">
                                <div class="list-table-header d-flex justify-content-sm-between mb-3">
                                    <button class="btn btn-primary" data-bs-target="#exampleModal" data-bs-toggle="modal"
                                        type="button">Add
                                    </button>
                                    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade"
                                        id="exampleModal" tabindex="-1">
                                        <form id="add_employee_form" method="POST"
                                            action="{{ route('designation.store') }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                                                            Designation
                                                        </h1>
                                                        <button aria-label="Close" class="btn-close m-0"
                                                            data-bs-dismiss="modal" type="button"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="name" name="name"
                                                                placeholder="Designation Name" required type="text">
                                                            <label class="form-label" for="name">Designation
                                                                Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer add">
                                                        <input class="btn btn-secondary" data-bs-dismiss="modal"
                                                            type="button" value="Close">
                                                        <input class="btn btn-primary" id="add-btn" type="submit"
                                                            value="Add">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="overflow-auto app-scroll">
                                    <table class="table table-bottom-border  list-table-data align-middle mb-0">
                                        <thead>
                                            <tr class="app-sort">
                                                <th class="">ID</th>
                                                <th class="sort">Name</th>
                                                <th class="sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="t-data">
                                            @foreach ($designation as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ ucwords($item->name) }}</td>

                                                    <td class="d-flex gap-2">
                                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id }}">
                                                            <i class="ph-duotone ph-pencil f-s-16"></i>
                                                        </button>

                                                        <form action="{{ route('designation.delete', $item->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                                <i class="ph-duotone ph-trash f-s-16"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Modal for THIS item -->
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('designation.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editModalLabel{{ $item->id }}">Update
                                                                        Designation</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="name{{ $item->id }}" name="name"
                                                                            value="{{ $item->name }}" required
                                                                            type="text">
                                                                        <label for="name{{ $item->id }}">Designation
                                                                            Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        Designation</button>
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
