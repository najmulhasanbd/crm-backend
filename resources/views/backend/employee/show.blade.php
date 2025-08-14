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

            <div class="row app-tabs-section">
                <!-- Tab 1 -->
                <div class="col-12">
                    <div class="card equal-card">
                        <div class="card-body">
                            <ul class="nav nav-tabs app-tabs-primary" id="Basic" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button aria-controls="leadinformation" aria-selected="true" class="nav-link active"
                                        data-bs-target="#lead-pane" data-bs-toggle="tab" id="lead" role="tab"
                                        type="button">Lead Information
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button aria-controls="leave-pane" aria-selected="false" class="nav-link"
                                        data-bs-target="#leave-pane" data-bs-toggle="tab" id="leave" role="tab"
                                        type="button">Leave Information
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="BasicContent">
                                <div aria-labelledby="lead" class="tab-pane fade show active" id="leadinformation"
                                    role="tabpanel" tabindex="0">
                                    <p class="mb-0">Hypertext Markup Language is the standard markup language
                                        for documents designed to be
                                        displayed in a web browser.</p>
                                    <p class="mb-0">It can be assisted by technologies such as Cascading Style
                                        Sheets (CSS) and scripting
                                        languages such as JavaScript.</p>
                                </div>
                                <div aria-labelledby="leave" class="tab-pane fade" id="leave-pane" role="tabpanel"
                                    tabindex="0">
                                    <p class="mb-0">Cascading Style Sheets (CSS) is a style sheet language used
                                        for describing the presentation
                                        of a document written in a markup language like HTML.</p>
                                    <p class="mb-0">CSS is a cornerstone technology of the World Wide Web,
                                        alongside HTML and JavaScript.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
