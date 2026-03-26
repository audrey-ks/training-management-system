@extends('layouts.app')
@section('title','Manage Users')
@section('page-title','Manage Users')

@section('content')
<div class="table-card">
    <div class="table-header flex-wrap gap-2">
        <strong class="fs-6">All Users</strong>
        <div class="d-flex gap-2 flex-wrap">
            {{-- Search & Filter --}}
            <form class="d-flex gap-2" method="GET">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name/email…" value="{{ request('search') }}">
                <select name="role" class="form-select form-select-sm" style="width:130px">
                    <option value="">All Roles</option>
                    <option value="admin"   {{ request('role')=='admin'   ? 'selected':'' }}>Admin</option>
                    <option value="trainer" {{ request('role')=='trainer' ? 'selected':'' }}>Trainer</option>
                    <option value="trainee" {{ request('role')=='trainee' ? 'selected':'' }}>Trainee</option>
                </select>
                <button class="btn btn-sm btn-secondary">Filter</button>
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary text-white">
                <i class="fa-solid fa-plus me-1"></i>Add User
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr>
                <th>#</th><th>Name</th><th>Email</th><th>Role</th>
                <th>Phone</th><th>Status</th><th>Joined</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @forelse($users as $u)
                <tr>
                    <td class="text-muted small">{{ $u->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                style="width:34px;height:34px;background:#2563eb;font-size:.8rem;flex-shrink:0">
                                {{ strtoupper(substr($u->name,0,1)) }}
                            </div>
                            <span class="fw-500">{{ $u->name }}</span>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $u->email }}</td>
                    <td>
                        @php $rc = ['admin'=>'badge-danger','trainer'=>'badge-info','trainee'=>'badge-warning']; @endphp
                        <span class="badge {{ $rc[$u->role] ?? 'badge-secondary' }}">{{ ucfirst($u->role) }}</span>
                    </td>
                    <td class="text-muted small">{{ $u->phone ?? '—' }}</td>
                    <td>
                        @if($u->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.users.edit',$u) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.users.toggle',$u) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $u->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                    title="{{ $u->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fa-solid {{ $u->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </form>
                            @if($u->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy',$u) }}" method="POST"
                                onsubmit="return confirm('Delete {{ $u->name }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted py-5">No users found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
        <div class="p-3">{{ $users->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
