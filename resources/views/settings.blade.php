@extends('layouts.app')
@section('title', 'Settings')
@section('page-title', 'Profile Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-card">
            <div class="text-center mb-4">
                <div class="avatar-preview mb-3 mx-auto position-relative" style="width: 120px; height: 120px;">
                    <img id="avatar-preview" src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="rounded-circle object-fit-cover w-100 h-100 shadow-lg border border-3 border-white" style="object-fit: cover;">
                    <label for="profile_photo" class="avatar-upload position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border: 3px solid white; font-size: .8rem;">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                </div>
                <h4>{{ auth()->user()->name }}</h4>
                <p class="text-muted">{{ ucfirst(auth()->user()->role) }}</p>
            </div>

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="profile_photo" id="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror" accept="image/*">
                    <div class="form-text">Upload JPG, PNG (max 2MB).</div>
                    @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-save me-2"></i>Update Profile
                    </button>
                </div>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <p class="mb-0 text-muted small">
                    <i class="fa-solid fa-envelope me-1"></i>
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('profile_photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

@push('styles')
<style>
.avatar-preview img {
    object-fit: cover;
}
.avatar-upload {
    cursor: pointer;
    right: -8px;
    bottom: -8px;
}
.avatar-upload:hover {
    background: var(--primary-dark) !important;
    transform: scale(1.05);
}
</style>
@endpush
@endsection

