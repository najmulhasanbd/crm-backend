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

                <form method="POST" class="card p-3" action="{{ route('lead.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 ">
                            <div class="mb-3">
                                <label class="form-label">Lead Type</label>
                                <select class="form-select" name="client_type" id="client_type" required
                                    style="height: 60px">
                                    <option value="">Select Lead Type</option>
                                    <option value="individual" {{ old('client_type') == 'individual' ? 'selected' : '' }}>
                                        Individual</option>
                                    <option value="agent" {{ old('client_type') == 'agent' ? 'selected' : '' }}>Agent
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 d-none company_div">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="company_name" name="company_name" placeholder="Company Name"
                                    type="text" value="{{ old('company_name') }}">
                                <label class="form-label" for="company_name">Company Name</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" name="name" placeholder="contact" required
                                    type="text" value="{{ old('name') }}">
                                <label class="form-label" for="name">Full
                                    Name</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="passport" name="passport" placeholder="contact" required
                                    type="text" value="{{ old('passport') }}">
                                <label class="form-label" for="passport">Passport</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div id="mobile-wrapper">
                                <div class="form-floating mb-3 mobile-input">
                                    <input class="form-control" name="mobile[]" placeholder="Mobile" type="number"
                                        value="{{ old('mobile.0') }}" required>
                                    <label class="form-label">Mobile</label>
                                    <button class="btn btn-success btn-sm mt-2 add-mobile" type="button">+</button>
                                </div>
                                @if ($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="whatsapp" name="whatsapp" placeholder="whatsapp" required
                                    type="number" value="{{ old('whatsapp') }}">
                                <label class="form-label" for="whatsapp">Whatsapp</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="age" name="age" placeholder="age" required
                                    type="number" value="{{ old('age') }}">
                                <label class="form-label" for="age">Age</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-select" name="country" required style="height: 60px">
                                    <option value="">Select Country</option>
                                    <option value="Afghanistan" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>
                                        Afghanistan</option>
                                    <option value="Zimbabwe" {{ old('country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label w-100 d-flex align-items-center justify-content-between">
                                    Job Role </label>
                                <select class="form-select" name="job_role" required style="height: 60px">
                                    @foreach ($jobRoles as $item)
                                        <option value="{{ $item->name }}"
                                            {{ old('job_role') == $item->name ? 'selected' : '' }}>
                                            {{ ucwords($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="experience" name="experience" placeholder="experience"
                                    required type="text" value="{{ old('experience') }}">
                                <label class="form-label" for="experience">Experience</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control basic-date" id="follow_up" name="follow_up"
                                    placeholder="YYYY-MM-DD" type="date" value="{{ old('follow_up') }}" required>
                                <label class="form-label" for="follow_up">Follow Up</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Education</label>
                                <select class="form-select" name="education" required style="height: 60px">
                                    @foreach ($education as $item)
                                        <option value="{{ $item->name }}"
                                            {{ old('education') == $item->name ? 'selected' : '' }}>
                                            {{ ucwords($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select class="form-select" name="priority" required style="height: 60px">
                                    <option value="">Select Priority</option>
                                    <option value="vip" {{ old('priority') == 'vip' ? 'selected' : '' }}>VIP</option>
                                    <option value="High Priority"
                                        {{ old('priority') == 'High Priority' ? 'selected' : '' }}>High Priority</option>
                                    <option value="Medium Priority"
                                        {{ old('priority') == 'Medium Priority' ? 'selected' : '' }}>Medium Priority
                                    </option>
                                    <option value="Low Priority"
                                        {{ old('priority') == 'Low Priority' ? 'selected' : '' }}>Low Priority</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required style="height: 60px">
                                    <option value="">Select Status</option>
                                    <option value="Booked" {{ old('status') == 'Booked' ? 'selected' : '' }}>Booked
                                    </option>
                                    <option value="Droped" {{ old('status') == 'Droped' ? 'selected' : '' }}>Droped
                                    </option>
                                    <option value="On Process" {{ old('status') == 'On Process' ? 'selected' : '' }}>On
                                        Process</option>
                                    <option value="Converted" {{ old('status') == 'Converted' ? 'selected' : '' }}>
                                        Converted</option>
                                    <option value="Rejected" {{ old('status') == 'Rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                    <option value="Need to Follow"
                                        {{ old('status') == 'Need to Follow' ? 'selected' : '' }}>Need to Follow</option>
                                    <option value="Passport New" {{ old('status') == 'Passport New' ? 'selected' : '' }}>
                                        Passport New</option>
                                    <option value="Payment New" {{ old('status') == 'Payment New' ? 'selected' : '' }}>
                                        Payment New</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lead Source</label>
                                <select class="form-select" name="source" required style="height: 60px">
                                    <option value="">Select Source</option>
                                    <option value="agent" {{ old('source') == 'agent' ? 'selected' : '' }}>Agent</option>
                                    <option value="facebook" {{ old('source') == 'facebook' ? 'selected' : '' }}>Facebook
                                    </option>
                                    <option value="youtube" {{ old('source') == 'youtube' ? 'selected' : '' }}>YouTube
                                    </option>
                                    <option value="google" {{ old('source') == 'google' ? 'selected' : '' }}>Google
                                    </option>
                                    <option value="whatsapp" {{ old('source') == 'whatsapp' ? 'selected' : '' }}>WhatsApp
                                    </option>
                                    <option value="referral" {{ old('source') == 'referral' ? 'selected' : '' }}>Referral
                                    </option>

                                    <option value="instagram" {{ old('source') == 'instagram' ? 'selected' : '' }}>
                                        Instagram</option>
                                    <option value="tiktok" {{ old('source') == 'tiktok' ? 'selected' : '' }}>TikTok
                                    </option>
                                    <option value="imo" {{ old('source') == 'imo' ? 'selected' : '' }}>IMO</option>
                                    <option value="referral" {{ old('source') == 'referral' ? 'selected' : '' }}>Referral
                                    </option>
                                    <option value="walk-in" {{ old('source') == 'walk-in' ? 'selected' : '' }}>Walk-in
                                    </option>
                                    <option value="digital_marketing"
                                        {{ old('source') == 'digital_marketing' ? 'selected' : '' }}>Digital Marketing
                                        (Organic)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="note">{{ old('note') }}</textarea>
                                <label class="form-label" for="note">Note</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer add">
                        <input class="btn btn-secondary" data-bs-dismiss="modal" type="button" value="Close">
                        <input class="btn btn-primary" id="add-btn" type="submit" value="Add">
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
