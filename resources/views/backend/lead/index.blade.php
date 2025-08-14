@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Lead List </h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a class="f-s-14 f-w-500" href="{{ route('lead.index') }}">
                                <span>
                                    <i class="ph-duotone  ph-table f-s-16"></i> Lead List
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Lead List</a>
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
                            <form id="add_employee_form" method="POST" action="{{ route('lead.store') }}">
                                @csrf
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                                                Lead
                                            </h1>
                                            <button aria-label="Close" class="btn-close m-0" data-bs-dismiss="modal"
                                                type="button"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="lead_id" name="lead_id"
                                                            placeholder="lead_id" required type="text">
                                                        <label class="form-label" for="lead_id">Lead ID</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="name" name="name"
                                                            placeholder="contact" required type="text">
                                                        <label class="form-label" for="name">Full
                                                            Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="passport" name="passport"
                                                            placeholder="contact" required type="text">
                                                        <label class="form-label" for="passport">Passport</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="mobile" name="mobile"
                                                            placeholder="Mobile" required type="text">
                                                        <label class="form-label" for="mobile">Mobile</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="whatsapp" name="whatsapp"
                                                            placeholder="whatsapp" required type="text">
                                                        <label class="form-label" for="whatsapp">Whatsapp</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="age" name="age"
                                                            placeholder="age" required type="number">
                                                        <label class="form-label" for="age">Age</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Country</label>
                                                        <select class="form-select" name="country" required
                                                            style="height: 60px">
                                                            <option value="">Select Country</option>
                                                            <option value="Afghanistan">Afghanistan</option>

                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Job Role</label>
                                                        <select class="form-select" name="job_role" required
                                                            style="height: 60px">
                                                            @foreach ($jobRoles as $item)
                                                                <option value="{{ $item->name }}">
                                                                    {{ ucwords($item->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="experience" name="experience"
                                                            placeholder="experience" required type="text">
                                                        <label class="form-label" for="experience">Experience</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="follow_up" name="follow_up"
                                                            placeholder="follow_up" required type="date">
                                                        <label class="form-label" for="follow_up">Follow
                                                            Up</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Education</label>
                                                        <select class="form-select" name="education" required
                                                            style="height: 60px">
                                                            @foreach ($education as $item)
                                                                <option value="{{ $item->name }}">
                                                                    {{ ucwords($item->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Priority</label>
                                                        <select class="form-select" name="priority" required
                                                            style="height: 60px">
                                                            <option value="">Select Priority</option>
                                                            <option value="vip">VIP</option>
                                                            <option value="High Priority">High Priority
                                                            </option>
                                                            <option value="Medium Priority">Medium Priority
                                                            </option>
                                                            <option value="Low Priority">Low Priority</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-select" name="status" required
                                                            style="height: 60px">
                                                            <option value="">Select Status</option>
                                                            <option value="Booked">Booked</option>
                                                            <option value="Droped">Droped</option>
                                                            <option value="On Process">On Process</option>
                                                            <option value="Converted">Converted</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="note"></textarea>
                                                        <label class="form-label" for="note">Note</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer add">
                                                <input class="btn btn-secondary" data-bs-dismiss="modal" type="button"
                                                    value="Close">
                                                <input class="btn btn-primary" id="add-btn" type="submit"
                                                    value="Add">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                            <th class="">SL</th>
                                            <th class="">Lead</th>
                                            <th class="sort">Name</th>
                                            <th class="sort">Passport</th>
                                            <th class="sort">Whatsap</th>
                                            <th class="sort">Mobile</th>
                                            <th class="sort">Country</th>
                                            <th class="sort">FollowUp</th>
                                            <th class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="t-data">
                                        @foreach ($leads as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->lead_id }}</td>
                                                <td>{{ ucwords($item->name) }}</td>
                                                <td>{{ $item->passport }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ ucwords($item->country) }}</td>

                                                @php
                                                    $followUp = $item->follow_up;

                                                    // Decode JSON if it's a string
                                                        if (is_string($followUp) && str_starts_with($followUp, '[')) {
                                                            $decoded = json_decode($followUp, true);
                                                            if (is_array($decoded) && count($decoded)) {
                                                                $followUp = end($decoded); // Get the last date
                                                            }
                                                        }


                                                    if (is_array($followUp)) {
                                                        $followUp = end($followUp);
                                                    }

                                                    // Format it (if date exists)
                                                    $lastDate = $followUp
                                                        ? \Carbon\Carbon::parse($followUp)->format('d M Y')
                                                        : 'N/A';
                                                @endphp

                                                <td>{{ $lastDate }}</td>


                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('lead.show', $item->id) }}"
                                                        class="btn btn-sm btn-info"> <i
                                                            class="ph-duotone ph-eye f-s-16"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $item->id }}">
                                                        <i class="ph-duotone ph-pencil f-s-16"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal for THIS item -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{ route('lead.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $item->id }}">Update Lead
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="lead_id"
                                                                                name="lead_id" placeholder="lead_id"
                                                                                required type="text" readonly
                                                                                value="{{ old('lead_id', $item->lead_id) }}">
                                                                            <label class="form-label" for="lead_id">Lead
                                                                                ID</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="name"
                                                                                name="name" placeholder="Full Name"
                                                                                required type="text"
                                                                                value="{{ old('name', $item->name) }}">
                                                                            <label class="form-label" for="name">Full
                                                                                Name</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="passport"
                                                                                name="passport" placeholder="Passport"
                                                                                required type="text"
                                                                                value="{{ old('passport', $item->passport) }}">
                                                                            <label class="form-label"
                                                                                for="passport">Passport</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="mobile"
                                                                                name="mobile" placeholder="Mobile"
                                                                                required type="text"
                                                                                value="{{ old('mobile', $item->mobile) }}">
                                                                            <label class="form-label"
                                                                                for="mobile">Mobile</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="whatsapp"
                                                                                name="whatsapp" placeholder="Whatsapp"
                                                                                type="text"
                                                                                value="{{ old('whatsapp', $item->whatsapp) }}">
                                                                            <label class="form-label"
                                                                                for="whatsapp">Whatsapp</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="age"
                                                                                name="age" placeholder="Age" required
                                                                                type="text"
                                                                                value="{{ old('age', $item->age) }}">
                                                                            <label class="form-label"
                                                                                for="age">Age</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Country</label>
                                                                            <select class="form-select" name="country"
                                                                                required style="height: 60px">
                                                                                <option value="">Select Country
                                                                                </option>
                                                                                <option value="Afghanistan"
                                                                                    {{ $item->country == 'Afghanistan' ? 'selected' : '' }}>
                                                                                    Afghanistan</option>
                                                                                <option value="Zimbabwe"
                                                                                    {{ $item->country == 'Zimbabwe' ? 'selected' : '' }}>
                                                                                    Zimbabwe</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Job Role</label>
                                                                            <select class="form-select" name="job_role"
                                                                                required style="height: 60px">
                                                                                @foreach ($jobRoles as $role)
                                                                                    <option value="{{ $role->name }}"
                                                                                        {{ $item->job_role == $role->name ? 'selected' : '' }}>
                                                                                        {{ ucwords($role->name) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="experience"
                                                                                name="experience" placeholder="Experience"
                                                                                required type="text"
                                                                                value="{{ old('experience', $item->experience) }}">
                                                                            <label class="form-label"
                                                                                for="experience">Experience</label>
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                        $followUpValue = $item->follow_up;

                                                                        if (
                                                                            is_string($followUpValue) &&
                                                                            str_starts_with($followUpValue, '[')
                                                                        ) {
                                                                            $decoded = json_decode(
                                                                                $followUpValue,
                                                                                true,
                                                                            );
                                                                            if (is_array($decoded) && count($decoded)) {
                                                                                $followUpValue = end($decoded);
                                                                            }
                                                                        }

                                                                        if (is_array($followUpValue)) {
                                                                            $followUpValue = end($followUpValue);
                                                                        }

                                                                        $formattedDate = $followUpValue
                                                                            ? \Carbon\Carbon::parse(
                                                                                $followUpValue,
                                                                            )->format('Y-m-d')
                                                                            : null;
                                                                    @endphp

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="follow_up"
                                                                                name="follow_up" type="date"
                                                                                placeholder="Follow Up" required
                                                                                value="{{ old('follow_up', $formattedDate) }}">
                                                                            <label class="form-label"
                                                                                for="follow_up">Follow Up</label>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-12 col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Education</label>
                                                                            <select class="form-select" name="education"
                                                                                required style="height: 60px">
                                                                                @foreach ($education as $edu)
                                                                                    <option value="{{ $edu->name }}"
                                                                                        {{ $item->education == $edu->name ? 'selected' : '' }}>
                                                                                        {{ ucwords($edu->name) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Priority</label>
                                                                            <select class="form-select" name="priority"
                                                                                required style="height: 60px">
                                                                                <option value="VIP"
                                                                                    {{ $item->priority == 'VIP' ? 'selected' : '' }}>
                                                                                    VIP</option>
                                                                                <option value="High Priority"
                                                                                    {{ $item->priority == 'High Priority' ? 'selected' : '' }}>
                                                                                    High Priority</option>
                                                                                <option value="Medium Priority"
                                                                                    {{ $item->priority == 'Medium Priority' ? 'selected' : '' }}>
                                                                                    Medium Priority</option>
                                                                                <option value="Low Priority"
                                                                                    {{ $item->priority == 'Low Priority' ? 'selected' : '' }}>
                                                                                    Low Priority</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Status</label>
                                                                            <select class="form-select" name="status"
                                                                                required style="height: 60px">
                                                                                <option value="Booked"
                                                                                    {{ $item->status == 'Booked' ? 'selected' : '' }}>
                                                                                    Booked</option>
                                                                                <option value="Droped"
                                                                                    {{ $item->status == 'Droped' ? 'selected' : '' }}>
                                                                                    Droped</option>
                                                                                <option value="On Process"
                                                                                    {{ $item->status == 'On Process' ? 'selected' : '' }}>
                                                                                    On Process</option>
                                                                                <option value="Converted"
                                                                                    {{ $item->status == 'Converted' ? 'selected' : '' }}>
                                                                                    Converted</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="Note">{{ old('note', $item->note) }}</textarea>
                                                                            <label class="form-label"
                                                                                for="note">Note</label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        Lead</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
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
