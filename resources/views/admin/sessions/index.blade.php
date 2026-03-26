@extends('layouts.app')
@section('title','Training Sessions')
@section('page-title','Training Sessions')

@section('content')
<div class="table-card">
    <div class="table-header flex-wrap gap-2">
        <strong class="fs-6">All Sessions</strong>
        <div class="d-flex gap-2 flex-wrap">
            <form class="d-flex gap-2" method="GET">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search title…" value="{{ request('search') }}">
                <select name="status" class="form-select form-select-sm" style="width:140px">
                    <option value="">All Status</option>
                    @foreach(['upcoming','active','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status')==$s ? 'selected':'' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-secondary">Filter</button>
            </form>
            <a href="{{ route('admin.sessions.create') }}" class="btn btn-sm btn-primary text-white">
                <i class="fa-solid fa-plus me-1"></i>New Session
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr>
                <th>Title</th><th>Trainer</th><th>Dates</th>
                <th>Status</th><th>Enrolled</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @forelse($sessions as $s)
                <tr>
                    <td>
                        <div class="fw-500">{{ $s->title }}</div>
                        <div class="text-muted small">{{ Str::limit($s->description,60) }}</div>
                    </td>
                    <td class="small">{{ $s->trainer->name ?? '<span class="text-muted">Unassigned</span>' }}</td>
                    <td class="small text-muted">
                        {{ $s->start_date->format('d M') }} — {{ $s->end_date->format('d M Y') }}
                    </td>
                    <td><span class="badge {{ $s->status_badge }}">{{ ucfirst($s->status) }}</span></td>
                    <td class="small text-center">{{ $s->enrollments_count ?? $s->enrollments()->count() }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.sessions.show',$s) }}" class="btn btn-sm btn-outline-info" title="View">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.sessions.edit',$s) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.sessions.destroy',$s) }}" method="POST"
                                onsubmit="return confirm('Delete session « {{ $s->title }} »?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-5">No sessions found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($sessions->hasPages())
        <div class="p-3">{{ $sessions->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
