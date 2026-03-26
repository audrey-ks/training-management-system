@extends('layouts.app')
@section('title','Edit User')
@section('page-title','Edit User')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 fw-700"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Edit: {{ $user->name }}</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>

            <form action="{{ route('admin.users.update',$user) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Full Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name',$user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Email Address *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email',$user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Role *</label>
                        <select name="role" class="form-select" required>
                            <option value="admin"   {{ old('role',$user->role)=='admin'   ? 'selected':'' }}>Admin</option>
                            <option value="trainer" {{ old('role',$user->role)=='trainer' ? 'selected':'' }}>Trainer</option>
                            <option value="trainee" {{ old('role',$user->role)=='trainee' ? 'selected':'' }}>Trainee</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone',$user->phone) }}">
                    </div>
                    <div class="col-12"><hr class="my-1"><p class="small text-muted mb-2">Leave password blank to keep unchanged.</p></div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="New password (optional)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary text-white px-4">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
