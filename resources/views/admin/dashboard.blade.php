@extends('layouts.app')
@section('title','Admin Dashboard')
@section('page-title','Dashboard')

@section('content')
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label'=>'Total Users',    'value'=>$stats['total_users'],    'icon'=>'fa-users',          'color'=>'#dbeafe','ic'=>'#2563eb'],
        ['label'=>'Trainers',       'value'=>$stats['total_trainers'], 'icon'=>'fa-chalkboard-user','color'=>'#dcfce7','ic'=>'#16a34a'],
        ['label'=>'Trainees',       'value'=>$stats['total_trainees'], 'icon'=>'fa-user-graduate',  'color'=>'#fef9c3','ic'=>'#ca8a04'],
        ['label'=>'Total Sessions', 'value'=>$stats['total_sessions'], 'icon'=>'fa-calendar-days',  'color'=>'#f3e8ff','ic'=>'#9333ea'],
        ['label'=>'Active Sessions','value'=>$stats['active_sessions'],'icon'=>'fa-circle-play',    'color'=>'#dcfce7','ic'=>'#16a34a'],
        ['label'=>'Enrollments',    'value'=>$stats['total_enrolls'],  'icon'=>'fa-clipboard-list', 'color'=>'#ffedd5','ic'=>'#ea580c'],
        ['label'=>'Materials',      'value'=>$stats['total_materials'],'icon'=>'fa-file-arrow-up',  'color'=>'#e0f2fe','ic'=>'#0284c7'],
    ];
    @endphp

    @foreach($cards as $c)
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:{{ $c['color'] }}">
                <i class="fa-solid {{ $c['icon'] }}" style="color:{{ $c['ic'] }}"></i>
            </div>
            <div class="value">{{ $c['value'] }}</div>
            <div class="label">{{ $c['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-3">
    {{-- Recent Sessions --}}
    <div class="col-lg-7">
        <div class="table-card">
            <div class="table-header">
                <strong>Recent Sessions</strong>
                <a href="{{ route('admin.sessions.index') }}" class="btn btn-sm btn-primary text-white">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr>
                        <th>Title</th><th>Trainer</th><th>Status</th><th>Start</th>
                    </tr></thead>
                    <tbody>
                    @forelse($recentSessions as $s)
                        <tr>
                            <td><a href="{{ route('admin.sessions.show',$s) }}" class="text-decoration-none fw-500">{{ $s->title }}</a></td>
                            <td>{{ $s->trainer->name ?? '—' }}</td>
                            <td><span class="badge {{ $s->status_badge }}">{{ ucfirst($s->status) }}</span></td>
                            <td class="text-muted small">{{ $s->start_date->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">No sessions yet</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Users --}}
    <div class="col-lg-5">
        <div class="table-card">
            <div class="table-header">
                <strong>Recent Users</strong>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary text-white">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Name</th><th>Role</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse($recentUsers as $u)
                        <tr>
                            <td>
                                <div class="fw-500">{{ $u->name }}</div>
                                <div class="text-muted" style="font-size:.75rem">{{ $u->email }}</div>
                            </td>
                            <td><span class="badge badge-info">{{ ucfirst($u->role) }}</span></td>
                            <td>
                                @if($u->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-4">No users yet</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
