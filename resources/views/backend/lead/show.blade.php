@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row m-1 mb-2">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h4 class="main-title">Lead Details: {{ $lead->name }}</h4>
                    <a href="{{ route('lead.index') }}" class="btn  btn-primary">Lead List</a>
                </div>
            </div>

            <!-- Lead Info Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><strong>Lead Information</strong></div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Lead ID</th>
                                        <td>{{ $lead->lead_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lead Concern</th>
                                        <td>{{ ucwords($lead->lead_concern) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Client Type</th>
                                        <td>{{ ucwords($lead->client_type) }}</td>
                                    </tr>
                                    @if ($lead->company_name)
                                        <tr>
                                            <th>Company Name</th>
                                            <td>{{ ucwords($lead->company_name) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Passport</th>
                                        <td>{{ $lead->passport }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>
                                            @php
                                                $mobiles = json_decode($lead->mobile, true);
                                            @endphp

                                            @if (!empty($mobiles))
                                                @foreach ($mobiles as $mobile)
                                                    <div>{{ $mobile }}</div>
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Whatsapp</th>
                                        <td>{{ $lead->whatsapp ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Age</th>
                                        <td>{{ $lead->age }} Years</td>
                                    </tr>
                                    <tr>
                                        <th>Which Country</th>
                                        <td>{{ $lead->country }}</td>
                                    </tr>
                                    <tr>
                                        <th>Job Role</th>
                                        <td>{{ $lead->job_role }}</td>
                                    </tr>
                                    <tr>
                                        <th>Education</th>
                                        <td>{{ $lead->education }}</td>
                                    </tr>
                                    <tr>
                                        <th>Experience</th>
                                        <td>{{ $lead->experience }} Years</td>
                                    </tr>
                                    <tr>
                                        <th>Priority</th>
                                        <td>
                                            @php
                                                $priorityClass = match ($lead->priority) {
                                                    'VIP' => 'badge bg-danger',
                                                    'High Priority' => 'badge bg-warning text-dark',
                                                    'Medium Priority' => 'badge bg-info text-dark',
                                                    'Low Priority' => 'badge bg-secondary',
                                                    default => 'badge bg-light text-dark',
                                                };
                                            @endphp
                                            <span class="{{ $priorityClass }}">{{ ucwords($lead->priority) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Lead Source</th>
                                        <td>
                                            @php
                                                $sourceClass = match ($lead->source) {
                                                    'agent' => 'badge bg-primary',
                                                    'facebook' => 'badge bg-info',
                                                    'youtube' => 'badge bg-danger',
                                                    'google' => 'badge bg-warning text-dark',
                                                    'whatsapp' => 'badge bg-success',
                                                    'instagram' => 'badge bg-secondary',
                                                    'tiktok' => 'badge bg-dark',
                                                    'imo' => 'badge bg-light text-dark',
                                                    'referral' => 'badge bg-info',
                                                    'walk-in' => 'badge bg-warning text-dark',
                                                    'digital_marketing' => 'badge bg-primary',
                                                    default => 'badge bg-light text-dark',
                                                };
                                            @endphp
                                            <span class="{{ $sourceClass }}">{{ ucfirst($lead->source) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @php
                                                $statusClass = match ($lead->status) {
                                                    'Booked' => 'badge bg-success',
                                                    'Droped' => 'badge bg-danger',
                                                    'On Process' => 'badge bg-warning text-dark',
                                                    'Converted' => 'badge bg-primary',
                                                    default => 'badge bg-light text-dark',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $lead->status }}</span>
                                        </td>
                                    </tr>
                                    @php
                                        $followUps = $lead->follow_up;
                                        if (is_string($followUps) && str_starts_with($followUps, '[')) {
                                            $followUps = json_decode($followUps, true);
                                        } elseif (!is_array($followUps)) {
                                            $followUps = [$followUps];
                                        }
                                        $followUps = array_filter($followUps);
                                    @endphp

                                    <tr>
                                        <th>Follow Ups</th>
                                        <td>
                                            @foreach ($followUps as $index => $date)
                                                @php
                                                    $position = $index + 1;
                                                    $suffix = match ($position) {
                                                        1 => 'st',
                                                        2 => 'nd',
                                                        3 => 'rd',
                                                        default => 'th',
                                                    };
                                                @endphp

                                                <strong>{{ $position }}{{ $suffix }} Follow:</strong>
                                                <button type="button" class="btn btn-sm btn-primary">
                                                    {{ \Carbon\Carbon::parse($date)->format('d-M-Y') }}
                                                </button>

                                                @if (!$loop->last)
                                                    |
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Assign Employee</th>
                                        <td>
                                            @if ($lead->assignedEmployees->isNotEmpty())
                                                @foreach ($lead->assignedEmployees as $employee)
                                                    <a href="{{ route('user.show', $employee->id) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary me-1 mb-1 text-decoration-none">
                                                        {{ ucwords($employee->name ?? '') }}
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="text-muted">
                                                    {{ 'No employee assigned' }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Collected Lead Employee</th>
                                        <td>{{ ucwords($lead->user->name ?? 'N/A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ ucwords($lead->address) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d-M-Y H:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Notes</th>
                                        <td>{{ $lead->note ?? 'No notes available.' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
