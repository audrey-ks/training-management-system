@extends('layouts.app')
@section('title','My Dashboard')
@section('page-title','My Dashboard')

@section('content')
<div class="row g-3 mb-4">
    @foreach([
        ['Enrolled',  $stats['enrolled'],  'fa-clipboard-list', '#dbeafe','#2563eb'],
        ['Active',    $stats['active'],    'fa-circle-play',    '#dcfce7','#16a34a'],
        ['Completed', $stats['completed'], 'fa-badge-check',    '#f3e8ff','#9333ea'],
    ] as [$lbl,$val,$icon,$bg,$ic])
    <div class="col-6 col-md-4">
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
    <div class="table-header">
        <strong>My Enrolled Sessions</strong>
        <a href="{{ route('trainee.sessions.index') }}" class="btn btn-sm btn-primary text-white">
            <i class="fa-solid fa-search me-1"></i>Browse All Sessions
        </a>
    </div>
    <div class="row g-0">
    @forelse($enrolledSessions as $s)
        <div class="col-12 border-bottom p-3">
            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                <div>
                    <div class="fw-500 mb-1">{{ $s->title }}</div>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge {{ $s->status_badge }}">{{ ucfirst($s->status) }}</span>
                        <span class="text-muted small"><i class="fa-solid fa-calendar me-1"></i>{{ $s->start_date->format('d M') }} — {{ $s->end_date->format('d M Y') }}</span>
                        <span class="text-muted small"><i class="fa-solid fa-file me-1"></i>{{ $s->materials_count }} materials</span>
                        @if($s->trainer)
                            <span class="text-muted small"><i class="fa-solid fa-chalkboard-user me-1"></i>{{ $s->trainer->name }}</span>
                        @endif
                    </div>
                </div>
                <a href="{{ route('trainee.sessions.show',$s) }}" class="btn btn-sm btn-outline-primary flex-shrink-0">
                    <i class="fa-solid fa-eye me-1"></i>View & Download
                </a>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fa-solid fa-graduation-cap fa-2x mb-3 d-block opacity-30"></i>
            You are not enrolled in any sessions yet.
            <a href="{{ route('trainee.sessions.index') }}" class="d-block mt-2">Browse available sessions</a>
        </div>
    @endforelse
    </div>
</div>
@endsection
