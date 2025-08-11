@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 d-flex" style="align-items: center;justify-content: space-between">
                    <h4 class="main-title">Employee Details ( {{ $employee->name }} ) </h4>
                    <div>
                        <a href="{{ route('employee.index') }}" class="btn btn-sm btn-success">Employee List</a>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Breadcrumb end -->
            <div class="row">
                <div class="col-12 col-md-4">
                    <img src="{{ asset('/uploads/employees/' . $employee->photo) }}" alt="Employee Photo"
                        class="w-100 border rounded-md p-3 ">
                    <button class="btn {{ $employee->status ? 'btn-success' : 'btn-danger' }}">
                        {{ $employee->status ? 'Active' : 'Inactive' }}
                    </button>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="overflow-auto">
                                <table class="table border table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="table-primary">Employee ID</th>
                                            <td>{{ $employee->id_card }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Name</th>
                                            <td>{{ ucwords($employee->name) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Department</th>
                                            <td>{{ ucwords($employee->department) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Designation</th>
                                            <td>{{ ucwords($employee->designation) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Blood Group</th>
                                            <td>{{ $employee->blood }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Salary</th>
                                            <td>{{ $employee->salary }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Commission</th>
                                            <td>{{ $employee->commission }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Email</th>
                                            <td>{{ $employee->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Mobile</th>
                                            <td>{{ $employee->mobile }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Date of Birth</th>
                                            <td>{{ \Carbon\Carbon::parse($employee->birth_date)->format('d-M-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Appointment Date</th>
                                            <td>{{ \Carbon\Carbon::parse($employee->appointment_date)->format('d-M-Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Date of Join</th>
                                            <td>{{ \Carbon\Carbon::parse($employee->join_date)->format('d-M-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Duration of Work</th>
                                            <td>
                                                @php
                                                    $joinDate = \Carbon\Carbon::parse($employee->join_date);
                                                    $now = \Carbon\Carbon::now();
                                                    $diff = $joinDate->diff($now);
                                                @endphp

                                                {{ $diff->y }} years {{ $diff->m }} months {{ $diff->d }}
                                                days
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="table-primary">Address</th>
                                            <td>{{ $employee->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
