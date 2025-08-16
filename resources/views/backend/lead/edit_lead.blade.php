@extends('backend.layouts.master')

@section('content')

    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Lead Create </h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a class="f-s-14 f-w-500" href="{{ route('lead.index') }}">
                                <span>
                                    <i class="ph-duotone  ph-table f-s-16"></i> Lead List
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a class="f-s-14 f-w-500" href="javascript:void(0)">Lead</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                    <div class="list-table-header d-flex justify-content-sm-between mb-3">
                        <a class="btn  btn-primary" href="{{ route('lead.index') }}">Lead List</a>
                    </div>
                </div>
            </div>
            <div class="row m-1">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('lead.update', $lead->id) }}" class="card p-3" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <!-- Lead Type -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Lead Type</label>
                                <select class="form-select" name="client_type" id="client_type" required
                                    style="height: 60px">
                                    <option value="">Select Lead Type</option>
                                    <option value="individual"
                                        {{ old('client_type', $lead->client_type) == 'individual' ? 'selected' : '' }}>
                                        Individual</option>
                                    <option value="agent"
                                        {{ old('client_type', $lead->client_type) == 'agent' ? 'selected' : '' }}>Agent
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Company Name -->
                        <div class="col-12 col-md-6 d-none company_div">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="company_name" name="company_name" placeholder="Company Name"
                                    type="text" value="{{ old('company_name', $lead->company_name) }}">
                                <label class="form-label" for="company_name">Company Name</label>
                            </div>
                        </div>

                        <!-- Full Name -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="name" placeholder="Full Name" required type="text"
                                    value="{{ old('name', $lead->name) }}">
                                <label class="form-label">Full Name</label>
                            </div>
                        </div>

                        <!-- Passport -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="passport" placeholder="Passport" required type="text"
                                    value="{{ old('passport', $lead->passport) }}">
                                <label class="form-label">Passport</label>
                            </div>
                        </div>

                        <!-- Mobile Numbers -->
                        <div class="col-12 col-md-6" id="mobile-wrapper">
                            @php
                                $mobiles = old('mobile', json_decode($lead->mobile, true) ?? []);
                                if (empty($mobiles)) {
                                    $mobiles = [''];
                                }
                            @endphp
                            @foreach ($mobiles as $index => $mobile)
                                <div class="form-floating mb-3 mobile-input">
                                    <input class="form-control" name="mobile[]" placeholder="Mobile" type="number"
                                        value="{{ $mobile }}" required>
                                    <label class="form-label">Mobile</label>
                                    @if ($index == 0)
                                        <button class="btn btn-success btn-sm mt-2 add-mobile" type="button">+</button>
                                    @else
                                        <button class="btn btn-danger btn-sm mt-2 remove-mobile" type="button">-</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Whatsapp -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="whatsapp" placeholder="Whatsapp" type="number"
                                    value="{{ old('whatsapp', $lead->whatsapp) }}">
                                <label class="form-label">Whatsapp</label>
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="age" placeholder="Age" type="number"
                                    value="{{ old('age', $lead->age) }}">
                                <label class="form-label">Age</label>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-select" name="country" style="height: 60px">
                                    <option value="">Select Country</option>
                                    <option value="Afghanistan"
                                        {{ old('country', $lead->country) == 'Afghanistan' ? 'selected' : '' }}>Afghanistan
                                    </option>
                                    <option value="Zimbabwe"
                                        {{ old('country', $lead->country) == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Job Role -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Job Role</label>
                                <select class="form-select" name="job_role" required style="height: 60px">
                                    @foreach ($jobRoles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('job_role', $lead->job_role) == $role->name ? 'selected' : '' }}>
                                            {{ ucwords($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="experience" placeholder="Experience" type="text"
                                    value="{{ old('experience', $lead->experience) }}">
                                <label class="form-label">Experience</label>
                            </div>
                        </div>

                        <!-- Follow Up -->
                        @php
                            $followUps = is_array(json_decode($lead->follow_up ?? '[]', true))
                                ? json_decode($lead->follow_up)
                                : [];
                            $latestFollowUp = !empty($followUps) ? end($followUps) : '';
                        @endphp

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="follow_up" type="date"
                                    value="{{ old('follow_up', $latestFollowUp) }}">
                                <label class="form-label">Follow Up</label>
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Education</label>
                                <select class="form-select" name="education" style="height: 60px">
                                    @foreach ($education as $edu)
                                        <option value="{{ $edu->name }}"
                                            {{ old('education', $lead->education) == $edu->name ? 'selected' : '' }}>
                                            {{ ucwords($edu->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Priority -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select class="form-select" name="priority" style="height: 60px">
                                    @php
                                        $priorities = [
                                            'vip' => 'VIP',
                                            'High Priority' => 'High Priority',
                                            'Medium Priority' => 'Medium Priority',
                                            'Low Priority' => 'Low Priority',
                                        ];
                                    @endphp
                                    @foreach ($priorities as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('priority', $lead->priority) == $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" style="height: 60px">
                                    @php
                                        $statuses = [
                                            'Booked',
                                            'Droped',
                                            'On Process',
                                            'Converted',
                                            'Rejected',
                                            'Need to Follow',
                                            'Passport New',
                                            'Payment New',
                                        ];
                                    @endphp @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ old('status', $lead->status) == $status ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Lead Source -->
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lead Source</label>
                                <select class="form-select" name="source" style="height: 60px">
                                    @php
                                        $sources = [
                                            'agent',
                                            'facebook',
                                            'youtube',
                                            'google',
                                            'whatsapp',
                                            'instagram',
                                            'tiktok',
                                            'imo',
                                            'referral',
                                            'walk-in',
                                            'digital_marketing',
                                        ];
                                    @endphp
                                    @foreach ($sources as $source)
                                        <option value="{{ $source }}"
                                            {{ old('source', $lead->source) == $source ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', $source)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Note -->
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="note">{{ old('note', $lead->note) }}</textarea>
                                <label class="form-label">Note</label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="modal-footer">
                            <input class="btn btn-secondary" data-bs-dismiss="modal" type="button" value="Close">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </div>
                    </div>
                </form>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const leadType = document.querySelectorAll('select[name="client_type"]');

            leadType.forEach(select => {
                const companyDiv = select.closest('.col-12').nextElementSibling; // next div is company_div
                const companyInput = companyDiv.querySelector('input[name="company_name"]');

                if (select.value === 'agent') {
                    companyDiv.classList.remove('d-none');
                    companyInput.setAttribute('required', 'required');
                } else {
                    companyDiv.classList.add('d-none');
                    companyInput.removeAttribute('required');
                }

                select.addEventListener('change', function() {
                    if (this.value === 'agent') {
                        companyDiv.classList.remove('d-none');
                        companyInput.setAttribute('required', 'required');
                    } else {
                        companyDiv.classList.add('d-none');
                        companyInput.removeAttribute('required');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let mobileWrapper = document.getElementById('mobile-wrapper');

            mobileWrapper.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('add-mobile')) {
                    let newInput = document.createElement('div');
                    newInput.classList.add('form-floating', 'mb-3', 'mobile-input');
                    newInput.innerHTML = `
                <input class="form-control" name="mobile[]" placeholder="Mobile" type="number" required>
                <label class="form-label">Mobile</label>
                <button class="btn btn-danger btn-sm mt-2 remove-mobile" type="button">-</button>
            `;
                    mobileWrapper.appendChild(newInput);
                }

                if (e.target && e.target.classList.contains('remove-mobile')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>

@endsection
