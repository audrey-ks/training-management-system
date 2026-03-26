@extends('layouts.app')
@section('title', 'Create Report')
@section('page-title', 'Generate New Report')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex align-items-center mb-4">
                <i class="fa-solid fa-chart-line fa-2x text-primary me-3"></i>
                <div>
                    <h5 class="mb-1 fw-700">Generate Report</h5>
                    <p class="text-muted mb-0">Select report type and title to generate detailed analytics.</p>
                </div>
            </div>

            <form action="{{ route('admin.reports.generate') }}" method="POST">
                @csrf
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-600">Report Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="">Choose report type...</option>
                            <option value="summary">📊 Dashboard Summary</option>
                            <option value="users">👥 Users Overview</option>
                            <option value="sessions">📅 Sessions Analysis</option>
                            <option value="enrollments">📋 Enrollments Report</option>
                            <option value="materials">📚 Materials Library</option>
                        </select>
                        @error('type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600">Report Title *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="e.g. Monthly User Activity Summary" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Reports
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-magic me-2"></i> Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

