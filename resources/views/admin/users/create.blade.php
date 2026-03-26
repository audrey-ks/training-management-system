@extends('layouts.app')
@section('title','Add User')
@section('page-title','Add New User')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 fw-700"><i class="fa-solid fa-user-plus me-2 text-primary"></i>Create User</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Full Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="John Doe" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Email Address *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="john@example.com" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Role *</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">Select role…</option>
                            <option value="admin"   {{ old('role')=='admin'   ? 'selected':'' }}>Admin</option>
                            <option value="trainer" {{ old('role')=='trainer' ? 'selected':'' }}>Trainer</option>
                            <option value="trainee" {{ old('role')=='trainee' ? 'selected':'' }}>Trainee</option>
                        </select>
                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+237600000000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Password *</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Min 6 characters" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary text-white px-4">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Create User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
