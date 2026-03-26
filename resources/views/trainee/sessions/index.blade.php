@extends('layouts.app')
@section('title','Browse Sessions')
@section('page-title','Available Sessions')

@section('content')
<div class="row g-3">
@forelse($sessions as $s)
    <div class="col-md-6 col-xl-4">
        <div class="stat-card h-100 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge {{ $s->status_badge }}">{{ ucfirst($s->status) }}</span>
                @if($enrolled->contains($s->id))
                    <span class="badge badge-success"><i class="fa-solid fa-check me-1"></i>Enrolled</span>
                @endif
            </div>
            <h6 class="fw-700 mb-1">{{ $s->title }}</h6>
            <p class="text-muted small flex-grow-1">{{ Str::limit($s->description, 100) }}</p>

            <div class="d-flex flex-column gap-1 my-2" style="font-size:.8rem">
                @if($s->trainer)
                    <span><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i>{{ $s->trainer->name }}</span>
                @endif
                <span><i class="fa-regular fa-calendar me-2 text-primary"></i>{{ $s->start_date->format('d M') }} — {{ $s->end_date->format('d M Y') }}</span>
                @if($s->location)
                    <span><i class="fa-solid fa-location-dot me-2 text-primary"></i>{{ $s->location }}</span>
                @endif
                <span><i class="fa-solid fa-users me-2 text-primary"></i>{{ $s->enrollments_count }} / {{ $s->max_trainees }} trainees</span>
                <span><i class="fa-solid fa-file me-2 text-primary"></i>{{ $s->materials_count }} materials</span>
            </div>

            <a href="{{ route('trainee.sessions.show',$s) }}" class="btn btn-primary btn-sm text-white mt-2">
                <i class="fa-solid fa-eye me-1"></i>View Details
            </a>
        </div>
    </div>
@empty
    <div class="col-12 text-center text-muted py-5">No sessions available.</div>
@endforelse
</div>

@if($sessions->hasPages())
    <div class="mt-4">{{ $sessions->links() }}</div>
@endif
@endsection
