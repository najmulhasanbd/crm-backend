@extends('backend.layouts.master')

@section('content')

    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 col-md-6">
                    <h4 class="main-title">Reject Lead List </h4>
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
                        <a class="btn  btn-primary" href="{{ route('lead.index') }}">Lead List</a>
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
                                        @foreach ($todayFollow as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->lead_id }}</td>
                                                <td>{{ ucwords($item->name) }}</td>
                                                <td>{{ $item->passport }}</td>
                                                <td>{{ $item->whatsapp }}</td>
                                                <td>
                                                    @if ($item->mobile)
                                                        {{ implode(', ', json_decode($item->mobile)) }}
                                                    @endif
                                                </td>
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
                                                    <a href="{{ route('lead.edit', $item->id) }}"
                                                        class="btn btn-sm btn-success"> <i
                                                            class="ph-duotone ph-pencil f-s-16"></i>
                                                    </a>
                                                </td>
                                            </tr>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const leadType = document.querySelectorAll('select[name="lead_type"]');

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


@endsection
