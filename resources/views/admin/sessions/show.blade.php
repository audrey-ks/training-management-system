@extends('layouts.app')
@section('title', $session->title)
@section('page-title', 'Session Detail')

@section('content')
<div class="row g-3">
    <div class="col-lg-8">
        <div class="form-card mb-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="fw-700 mb-1">{{ $session->title }}</h5>
                    <span class="badge {{ $session->status_badge }} me-2">{{ ucfirst($session->status) }}</span>
                    <span class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i>{{ $session->location ?? 'N/A' }}</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.sessions.edit',$session) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>
                    <a href="{{ route('admin.sessions.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
            </div>
            <p class="text-muted">{{ $session->description ?? 'No description provided.' }}</p>
            <div class="row g-2 mt-1">
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Trainer</div>
                        <div class="fw-600 small">{{ $session->trainer->name ?? 'Unassigned' }}</div>
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
                        <div class="small text-muted">Capacity</div>
                        <div class="fw-600 small">{{ $session->trainees->count() }} / {{ $session->max_trainees }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Materials --}}
        <div class="table-card">
            <div class="table-header"><strong>Materials ({{ $session->materials->count() }})</strong></div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
<th>Title</th><th>Status</th><th>Type</th><th>Size</th><th>Uploaded</th><th>Actions</th>
                    <tbody>
                    @forelse($session->materials as $m)
                        <tr>
                            <td><i class="fa-solid {{ $m->material_icon }} me-2 text-primary"></i>{{ $m->title }}</td>
                            <td><span class="badge badge-{{ $m->status_badge }}">{{ $m->status_label }}</span></td>
                            <td><span class="badge badge-info">{{ ucfirst($m->material_type) }}</span></td>
                            <td class="small text-muted">{{ $m->file_size_human }}</td>
                            <td class="small">{{ $m->uploader->name ?? '—' }}</td>
                            <td>
                                @if($m->status === 'pending')
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning dropdown-toggle" data-bs-toggle="dropdown">
                                            Review
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('admin.sessions.materials.approve', [$session, $m]) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-check text-success me-1"></i>Approve
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.sessions.materials.reject', [$session, $m]) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Reject?')">
                                                        <i class="fa-solid fa-xmark me-1"></i>Reject
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No materials uploaded yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Enrolled Trainees --}}
    <div class="col-lg-4">
        <div class="table-card">
            <div class="table-header"><strong>Enrolled Trainees ({{ $session->trainees->count() }})</strong></div>
            <ul class="list-group list-group-flush">
            @forelse($session->trainees as $t)
                <li class="list-group-item d-flex align-items-center gap-2 py-2">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width:30px;height:30px;font-size:.75rem;font-weight:700;flex-shrink:0">
                        {{ strtoupper(substr($t->name,0,1)) }}
                    </div>
                    <div>
                        <div class="fw-500 small">{{ $t->name }}</div>
                        <div class="text-muted" style="font-size:.72rem">{{ $t->email }}</div>
                    </div>
                    <span class="badge ms-auto {{ $t->pivot->status=='completed' ? 'badge-success' : 'badge-info' }}">
                        {{ ucfirst($t->pivot->status) }}
                    </span>
                </li>
            @empty
                <li class="list-group-item text-center text-muted py-4">No trainees enrolled.</li>
            @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
