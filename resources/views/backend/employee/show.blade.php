@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Employee List </h4>
                    <div class="d-flex" style="align-items: center;justify-content: space-between">
                        <div>
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
                        <div>
                            <a href="{{ route('employee.index') }}" class="btn btn-sm btn-success">Employee List</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Breadcrumb end -->
            <div class="row">
                <!-- List Js Table start -->
                <div class="col-12">
                    <h1>Employee Details</h1>
                    <img src="{{ asset('storage/uploads/employees/' . $employee->photo) }}" alt="Employee Photo"
                        width="100">


                    <p><strong>ID Card:</strong> {{ $employee->id_card }}</p>
                    <p><strong>Name:</strong> {{ $employee->name }}</p>
                    <p><strong>Department:</strong> {{ $employee->department }}</p>
                    <p><strong>Designation:</strong> {{ $employee->designation }}</p>
                    <p><strong>Blood Group:</strong> {{ $employee->blood }}</p>
                    <p><strong>Salary:</strong> {{ $employee->salary }}</p>
                    <p><strong>Commission:</strong> {{ $employee->commission }}</p>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p><strong>Mobile:</strong> {{ $employee->mobile }}</p>
                    <p><strong>Birth Date:</strong> {{ $employee->birth_date }}</p>
                    <p><strong>Appointment Date:</strong> {{ $employee->appointment_date }}</p>
                    <p><strong>Join Date:</strong> {{ $employee->join_date }}</p>
                    <p><strong>Address:</strong> {!! nl2br(e($employee->address)) !!}</p>
                </div>
            </div>
        </div>
    </main>
@endsection
