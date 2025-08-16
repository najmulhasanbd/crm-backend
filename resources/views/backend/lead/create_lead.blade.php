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
                            <div class="mb-3">
                                <label class="form-label">Lead Concern</label>
                                <select class="form-select" name="lead_concern" required style="height: 60px">
                                    <option value="">Select Lead Concern</option>
                                    <option value="World Flight Travels"
                                        {{ old('lead_concern') == 'World Flight Travels' ? 'selected' : '' }}>
                                        World Flight Travels</option>
                                    <option value="Flyori Travel"
                                        {{ old('lead_concern') == 'Flyori Travel' ? 'selected' : '' }}>Flyori Travel
                                    </option>
                                </select>
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
                                <label class="form-label">Which Country</label>
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
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address/Location</label>
                                <select class="form-select" name="address" id="addressSelect" required
                                    style="height: 60px">
                                    <option value="">Select Address/Location</option>
                                    <option value="Dhaka" @selected(old('address', $lead->address ?? '') == 'Dhaka')>Dhaka</option>
                                    <option value="Gazipur" @selected(old('address', $lead->address ?? '') == 'Gazipur')>Gazipur</option>
                                    <option value="other" @selected(!in_array(old('address', $lead->address ?? ''), ['Dhaka', 'Gazipur', '']))>Others</option>
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
                    <div class="modal-footer d-flex gap-2">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressSelect = document.getElementById('addressSelect');
            const otherInput = document.getElementById('otherAddressInput');
            const suggestions = document.getElementById('countrySuggestions');

            // List of all countries (example)
            const countries = [
                "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antarctica",
                "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",
                "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin",
                "Bermuda", "Bhutan", "Bolivia", "Bonaire, Sint Eustatius and Saba", "Bosnia and Herzegovina",
                "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam",
                "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada",
                "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island",
                "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo (the Democratic Republic of the)",
                "Congo (the)", "Cook Islands", "Costa Rica", "Croatia", "Cuba", "Curaçao", "Cyprus", "Czechia",
                "Côte d'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt",
                "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia",
                "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana",
                "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany",
                "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala",
                "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands",
                "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq",
                "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan",
                "Kazakhstan", "Kenya", "Kiribati", "Korea (North)", "Korea (South)", "Kuwait", "Kyrgyzstan",
                "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
                "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar", "Malawi", "Malaysia",
                "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius",
                "Mayotte", "Mexico", "Micronesia (Federated States of)", "Moldova", "Monaco", "Mongolia",
                "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
                "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue",
                "Norfolk Island", "North Macedonia", "Northern Mariana Islands", "Norway", "Oman", "Pakistan",
                "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn Islands",
                "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russian Federation", "Rwanda",
                "Réunion", "Saint Barthélemy", "Saint Helena, Ascension and Tristan da Cunha",
                "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Pierre and Miquelon",
                "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe",
                "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten",
                "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
                "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", "Sri Lanka", "Sudan",
                "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan",
                "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga",
                "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine",
                "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan",
                "Vanuatu", "Venezuela", "Viet Nam", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"
            ];

            // Show/hide input field when 'Other' selected
            addressSelect.addEventListener('change', function() {
                if (this.value === 'other') {
                    otherInput.style.display = 'block';
                    otherInput.setAttribute('required', 'required');
                    otherInput.focus();
                } else {
                    otherInput.style.display = 'none';
                    otherInput.removeAttribute('required');
                    suggestions.style.display = 'none';
                }
            });

            // Autocomplete logic
            otherInput.addEventListener('input', function() {
                const val = this.value.trim();
                suggestions.innerHTML = '';
                if (val.length >= 4) { // only after 4 chars
                    const matches = countries.filter(c => c.toLowerCase().includes(val.toLowerCase()));
                    if (matches.length > 0) {
                        matches.forEach(c => {
                            const li = document.createElement('li');
                            li.textContent = c;
                            li.classList.add('list-group-item');
                            li.style.cursor = 'pointer';
                            li.addEventListener('click', function() {
                                otherInput.value = c;
                                suggestions.style.display = 'none';
                            });
                            suggestions.appendChild(li);
                        });
                        suggestions.style.display = 'block';
                    } else {
                        suggestions.style.display = 'none';
                    }
                } else {
                    suggestions.style.display = 'none';
                }
            });

            // Hide suggestions if clicked outside
            document.addEventListener('click', function(e) {
                if (!otherInput.contains(e.target) && !suggestions.contains(e.target)) {
                    suggestions.style.display = 'none';
                }
            });
        });
    </script>
@endsection
