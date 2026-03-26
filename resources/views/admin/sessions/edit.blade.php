@extends('layouts.app')
@section('title','Edit Session')
@section('page-title','Edit Session')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 fw-700"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Edit: {{ $session->title }}</h5>
                <a href="{{ route('admin.sessions.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <form action="{{ route('admin.sessions.update',$session) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-600 small">Session Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title',$session->title) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600 small">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description',$session->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Assign Trainer</label>
                        <select name="trainer_id" class="form-select">
                            <option value="">— Unassigned —</option>
                            @foreach($trainers as $t)
                                <option value="{{ $t->id }}" {{ old('trainer_id',$session->trainer_id)==$t->id ? 'selected':'' }}>{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location',$session->location) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600 small">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date',$session->start_date->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600 small">End Date *</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date',$session->end_date->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-600 small">Max Trainees</label>
                        <input type="number" name="max_trainees" class="form-control" value="{{ old('max_trainees',$session->max_trainees) }}" min="1">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-600 small">Status</label>
                        <select name="status" class="form-select">
                            @foreach(['upcoming','active','completed','cancelled'] as $s)
                                <option value="{{ $s }}" {{ old('status',$session->status)==$s ? 'selected':'' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary text-white px-4"><i class="fa-solid fa-floppy-disk me-2"></i>Save</button>
                    <a href="{{ route('admin.sessions.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
