@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Employee List </h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a class="f-s-14 f-w-500" href="{{ route('employee.index') }}">
                                <span>
                                    <i class="ph-duotone  ph-table f-s-16"></i> Employee List
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Employee List</a>
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
                                        <form id="add_employee_form" method="POST" action="{{ route('employee.store') }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                                                            Employee
                                                        </h1>
                                                        <button aria-label="Close" class="btn-close m-0"
                                                            data-bs-dismiss="modal" type="button"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="id_card" name="id_card"
                                                                placeholder="contact" required type="text">
                                                            <label class="form-label" for="id_card">Employee ID</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="name" name="name"
                                                                placeholder="contact" required type="text">
                                                            <label class="form-label" for="name">Employee Name</label>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Department</label>
                                                            <select class="form-select" name="department"
                                                                style="height: 60px">
                                                                @foreach ($department as $item)
                                                                    <option value="{{ $item->name }}">
                                                                        {{ ucwords($item->name) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Designation</label>
                                                            <select class="form-select" name="designation"
                                                                style="height: 60px">
                                                                @foreach ($designation as $item)
                                                                    <option value="{{ $item->name }}">
                                                                        {{ ucwords($item->name) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Blood Group</label>
                                                            <select class="form-select" name="blood" style="height: 60px">
                                                                <option value="">Select Blood Group</option>
                                                                <option value="A+">A+</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B+">B+</option>
                                                                <option value="B-">B-</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="AB-">AB-</option>
                                                                <option value="O+">O+</option>
                                                                <option value="O-">O-</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="salary" name="salary"
                                                                placeholder="contact" required type="text">
                                                            <label class="form-label" for="salary">Employee Salary</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="commission" name="commission"
                                                                placeholder="contact" required type="text">
                                                            <label class="form-label" for="commission">Commission</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="email" name="email"
                                                                placeholder="contact" required type="email">
                                                            <label class="form-label" for="email">Email</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="mobile" name="mobile"
                                                                placeholder="contact" required type="text">
                                                            <label class="form-label" for="mobile">Mobile</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="birth_date" id="birth_date"
                                                                type="date">
                                                            <label for="birth_date">Date of
                                                                Birth</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="appointment_date"
                                                                id="appointment_date" type="date">
                                                            <label for="appointment_date">Date of
                                                                Appoinment</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" id="join_date" name="join_date"
                                                                type="date">
                                                            <label for="join_date">Joining Date</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <textarea name="address" id="address" class="form-control" cols="30" rows="5"></textarea>
                                                            <label class="form-label" for="address">Address</label>
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
                                                <th class="sort">Mobile</th>
                                                <th class="sort">Designation</th>
                                                <th class="sort">Department</th>
                                                <th class="sort">Salary</th>
                                                <th class="sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="t-data">
                                            @foreach ($employee as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ ucwords($item->name) }}</td>
                                                    <td>{{ ucwords($item->mobile) }}</td>
                                                    <td>{{ ucwords($item->designation) }}</td>
                                                    <td>{{ ucwords($item->department) }}</td>
                                                    <td>{{ ucwords($item->salary) }}</td>

                                                    <td class="d-flex gap-2">
                                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id }}">
                                                            <i class="ph-duotone ph-eye f-s-16"></i>
                                                        </button>

                                                        <form action="{{ route('employee.delete', $item->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger btn-delete">
                                                                <i class="ph-duotone ph-trash f-s-16"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Modal for THIS item -->
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('employee.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editModalLabel{{ $item->id }}">Update
                                                                        Employee</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    {{-- Employee ID --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="id_card{{ $item->id }}"
                                                                            name="id_card" value="{{ $item->id_card }}"
                                                                            required type="text">
                                                                        <label for="id_card{{ $item->id }}">Employee
                                                                            ID</label>
                                                                    </div>

                                                                    {{-- Name --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="name{{ $item->id }}" name="name"
                                                                            value="{{ $item->name }}" required
                                                                            type="text">
                                                                        <label for="name{{ $item->id }}">Employee
                                                                            Name</label>
                                                                    </div>

                                                                    {{-- Department --}}
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Department</label>
                                                                        <select class="form-select" name="department"
                                                                            style="height: 60px">
                                                                            @foreach ($department as $dept)
                                                                                <option value="{{ $dept->name }}"
                                                                                    {{ $item->department == $dept->name ? 'selected' : '' }}>
                                                                                    {{ ucwords($dept->name) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    {{-- Designation --}}
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Designation</label>
                                                                        <select class="form-select" name="designation"
                                                                            style="height: 60px">
                                                                            @foreach ($designation as $desig)
                                                                                <option value="{{ $desig->name }}"
                                                                                    {{ $item->designation == $desig->name ? 'selected' : '' }}>
                                                                                    {{ ucwords($desig->name) }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    {{-- Blood Group --}}
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Blood Group</label>
                                                                        <select class="form-select" name="blood"
                                                                            style="height: 60px">
                                                                            <option value="">Select Blood Group
                                                                            </option>
                                                                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                                                                <option value="{{ $group }}"
                                                                                    {{ $item->blood == $group ? 'selected' : '' }}>
                                                                                    {{ $group }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    {{-- Salary --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="salary{{ $item->id }}" name="salary"
                                                                            value="{{ $item->salary }}" required
                                                                            type="number" step="0.01">
                                                                        <label for="salary{{ $item->id }}">Employee
                                                                            Salary</label>
                                                                    </div>

                                                                    {{-- Commission --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="commission{{ $item->id }}"
                                                                            name="commission"
                                                                            value="{{ $item->commission }}" required
                                                                            type="number" step="0.01">
                                                                        <label
                                                                            for="commission{{ $item->id }}">Commission</label>
                                                                    </div>

                                                                    {{-- Email --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="email{{ $item->id }}" name="email"
                                                                            value="{{ $item->email }}" required
                                                                            type="email">
                                                                        <label
                                                                            for="email{{ $item->id }}">Email</label>
                                                                    </div>

                                                                    {{-- Mobile --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="mobile{{ $item->id }}" name="mobile"
                                                                            value="{{ $item->mobile }}" required
                                                                            type="text">
                                                                        <label
                                                                            for="mobile{{ $item->id }}">Mobile</label>
                                                                    </div>

                                                                    {{-- Birth Date --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control" name="birth_date"
                                                                            id="birth_date{{ $item->id }}"
                                                                            value="{{ $item->birth_date }}"
                                                                            type="date">
                                                                        <label for="birth_date{{ $item->id }}">Date of
                                                                            Birth</label>
                                                                    </div>

                                                                    {{-- Appointment Date --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            name="appointment_date"
                                                                            id="appointment_date{{ $item->id }}"
                                                                            value="{{ $item->appointment_date }}"
                                                                            type="date">
                                                                        <label
                                                                            for="appointment_date{{ $item->id }}">Date
                                                                            of Appointment</label>
                                                                    </div>

                                                                    {{-- Join Date --}}
                                                                    <div class="form-floating mb-3">
                                                                        <input class="form-control"
                                                                            id="join_date{{ $item->id }}"
                                                                            name="join_date"
                                                                            value="{{ $item->join_date }}"
                                                                            type="date">
                                                                        <label for="join_date{{ $item->id }}">Joining
                                                                            Date</label>
                                                                    </div>

                                                                    {{-- Address --}}
                                                                    <div class="form-floating mb-3">
                                                                        <textarea name="address" id="address{{ $item->id }}" class="form-control" rows="5">{{ $item->address }}</textarea>
                                                                        <label
                                                                            for="address{{ $item->id }}">Address</label>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        Employee</button>
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
