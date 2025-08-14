@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row m-1 mb-2">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h4 class="main-title">Lead Details: {{ $lead->name }}</h4>
                    <a href="{{ route('lead.index') }}" class="btn btn-sm btn-success">Lead List</a>
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
                                        <th>Passport</th>
                                        <td>{{ $lead->passport }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>{{ $lead->mobile }}</td>
                                    </tr>
                                    <tr>
                                        <th>Whatsapp</th>
                                        <td>{{ $lead->whatsapp ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Age</th>
                                        <td>{{ $lead->age }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
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
                                        <td>{{ $lead->experience }}</td>
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
                                            @if ($lead->assignedEmployees->count())
                                                @if ($lead->assignedEmployees->count())
                                                    @foreach ($lead->assignedEmployees as $employee)
                                                        <a href="{{ route('user.show', $employee->id) }}" target="_blank"
                                                            class="btn btn-sm btn-outline-primary me-1 mb-1 text-decoration-none">
                                                            {{ ucwords($employee->name ?? '') }}
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">No employee assigned</span>
                                                @endif
                                            @else
                                                <span class="text-muted">{{ ucwords($lead->user->name ?? 'N/A') }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Collected Lead Employee</th>
                                        <td>{{ ucwords($lead->user->name ?? 'N/A') }}</td>
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
