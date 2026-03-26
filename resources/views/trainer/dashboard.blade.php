@extends('layouts.app')
@section('title','Trainer Dashboard')
@section('page-title','My Dashboard')

@section('content')
<div class="row g-3 mb-4">
    @foreach([
        ['My Sessions',   $stats['total_sessions'],  'fa-calendar-days',  '#dbeafe','#2563eb'],
        ['Active',        $stats['active_sessions'],  'fa-circle-play',    '#dcfce7','#16a34a'],
        ['Materials',     $stats['total_materials'],  'fa-file-arrow-up',  '#f3e8ff','#9333ea'],
        ['Total Trainees',$stats['total_trainees'],   'fa-user-graduate',  '#fef9c3','#ca8a04'],
    ] as [$lbl,$val,$icon,$bg,$ic])
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="icon" style="background:{{ $bg }}">
                <i class="fa-solid {{ $icon }}" style="color:{{ $ic }}"></i>
            </div>
            <div class="value">{{ $val }}</div>
            <div class="label">{{ $lbl }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="table-card">
    <div class="table-header"><strong>My Assigned Sessions</strong></div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr>
                <th>Session</th><th>Dates</th><th>Status</th>
                <th>Trainees</th><th>Materials</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @forelse($sessions as $s)
                <tr>
                    <td>
                        <div class="fw-500">{{ $s->title }}</div>
                        <div class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i>{{ $s->location ?? 'N/A' }}</div>
                    </td>
                    <td class="small text-muted">
                        {{ $s->start_date->format('d M') }} — {{ $s->end_date->format('d M Y') }}
                    </td>
                    <td><span class="badge {{ $s->status_badge }}">{{ ucfirst($s->status) }}</span></td>
                    <td class="text-center small">{{ $s->enrollments_count }}</td>
                    <td class="text-center small">{{ $s->materials_count }}</td>
                    <td>
                        <a href="{{ route('trainer.sessions.materials',$s) }}" class="btn btn-sm btn-primary text-white">
                            <i class="fa-solid fa-file-arrow-up me-1"></i>Manage Materials
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-5">No sessions assigned to you yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
