@extends('layouts.app')
@section('title', $session->title)
@section('page-title', 'Session Detail')

@section('content')
<div class="row g-3">
    <div class="col-lg-8">
        <div class="form-card mb-3">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="fw-700 mb-1">{{ $session->title }}</h5>
                    <span class="badge {{ $session->status_badge }} me-2">{{ ucfirst($session->status) }}</span>
                    @if($session->location)
                        <span class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i>{{ $session->location }}</span>
                    @endif
                </div>
                <a href="{{ route('trainee.sessions.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
            </div>
            <p class="text-muted">{{ $session->description ?? 'No description provided.' }}</p>
            <div class="row g-2">
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Trainer</div>
                        <div class="fw-600 small">{{ $session->trainer->name ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Start</div>
                        <div class="fw-600 small">{{ $session->start_date->format('d M Y') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">End</div>
                        <div class="fw-600 small">{{ $session->end_date->format('d M Y') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Spots Left</div>
                        <div class="fw-600 small">{{ max(0,$session->max_trainees - $session->enrollments()->count()) }}</div>
                    </div>
                </div>
            </div>

            @if(!$enrolled)
                <form action="{{ route('trainee.sessions.enroll',$session) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary text-white">
                        <i class="fa-solid fa-pen-to-square me-2"></i>Enroll in this Session
                    </button>
                </form>
            @else
                <div class="alert alert-success mt-3 mb-0 py-2 small">
                    <i class="fa-solid fa-circle-check me-2"></i>You are enrolled — status: <strong>{{ ucfirst($enrolled->status) }}</strong>
                </div>
            @endif
        </div>

        {{-- Materials --}}
        <div class="table-card">
            <div class="table-header">
                <strong>Session Materials ({{ $materials->count() }})</strong>
                @if(!$enrolled)
                    <span class="badge badge-warning small">Enroll to download</span>
                @endif
            </div>
            @forelse($materials as $m)
            <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width:44px;height:44px;flex-shrink:0;background:#f1f5f9">
                    @php
                    $colors = ['image'=>'#16a34a','video'=>'#9333ea','audio'=>'#ca8a04','document'=>'#2563eb','other'=>'#64748b'];
                    @endphp
                    <i class="fa-solid {{ $m->material_icon }}" style="color:{{ $colors[$m->material_type] ?? '#64748b' }};font-size:1.2rem"></i>
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="fw-500">{{ $m->title }}</div>
                    @if($m->description)
                        <div class="text-muted small">{{ $m->description }}</div>
                    @endif
                    <div class="d-flex gap-2 mt-1 flex-wrap">
                        <span class="badge badge-info">{{ ucfirst($m->material_type) }}</span>
                        <span class="text-muted" style="font-size:.75rem">{{ $m->file_size_human }}</span>
                        <span class="text-muted" style="font-size:.75rem">{{ $m->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                @if($enrolled)
                    <a href="{{ route('trainee.materials.download',[$session,$m]) }}"
                        class="btn btn-sm btn-outline-success flex-shrink-0">
                        <i class="fa-solid fa-download"></i>
                    </a>
                @else
                    <button class="btn btn-sm btn-outline-secondary flex-shrink-0" disabled title="Enroll first">
                        <i class="fa-solid fa-lock"></i>
                    </button>
                @endif
            </div>
            @empty
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-folder-open fa-2x mb-2 d-block opacity-30"></i>
                No materials have been uploaded yet.
            </div>
            @endforelse
        </div>
    </div>

    {{-- Side info --}}
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-700 mb-3">Session Info</h6>
            <ul class="list-unstyled" style="font-size:.875rem">
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Status</span>
                    <span class="badge {{ $session->status_badge }}">{{ ucfirst($session->status) }}</span>
                </li>
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Trainer</span>
                    <span>{{ $session->trainer->name ?? 'TBD' }}</span>
                </li>
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Duration</span>
                    <span>{{ $session->start_date->diffInDays($session->end_date) + 1 }} days</span>
                </li>
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Enrolled</span>
                    <span>{{ $session->enrollments()->count() }} / {{ $session->max_trainees }}</span>
                </li>
                <li class="py-2 d-flex justify-content-between">
                    <span class="text-muted">Materials</span>
                    <span>{{ $materials->count() }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
