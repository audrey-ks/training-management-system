@extends('layouts.app')
@section('title','Manage Materials')
@section('page-title','Manage Materials')

@section('content')
<div class="row g-3">
    {{-- Upload Form --}}
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-700 mb-3"><i class="fa-solid fa-cloud-arrow-up me-2 text-primary"></i>Upload Material</h6>
            <p class="small text-muted mb-3">Session: <strong>{{ $session->title }}</strong></p>
            <form action="{{ route('trainer.materials.store', $session) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-600 small">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" placeholder="e.g. Week 1 Slides" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-600 small">Description</label>
                    <textarea name="description" class="form-control" rows="2"
                        placeholder="Brief description…">{{ old('description') }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-600 small">File * <span class="text-muted">(max 100MB)</span></label>
                    <input type="file" name="file" id="fileInput"
                        class="form-control @error('file') is-invalid @enderror"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt,.png,.jpg,.jpeg,.gif,.mp4,.avi,.mov,.mp3,.zip,.rar"
                        required>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div id="fileInfo" class="mt-2 small text-muted d-none">
                        <i class="fa-solid fa-file me-1"></i><span id="fileName"></span>
                        — <span id="fileSize"></span>
                    </div>
                </div>

                {{-- Accepted Types Display --}}
                <div class="bg-light rounded p-2 mb-3" style="font-size:.75rem">
                    <strong>Accepted:</strong> PDF, Word, PPT, Excel, Images (PNG/JPG/GIF), Videos (MP4/AVI/MOV), Audio (MP3), ZIP/RAR
                </div>

                <button type="submit" class="btn btn-primary text-white w-100">
                    <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>Upload Material
                </button>
            </form>
        </div>
    </div>

    {{-- Materials List --}}
    <div class="col-lg-8">
        <div class="table-card">
            <div class="table-header">
                <strong>Materials in "{{ $session->title }}" ({{ $materials->count() }})</strong>
            </div>
            @forelse($materials as $m)
            <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width:44px;height:44px;flex-shrink:0;background:#f1f5f9">
                    @php
                    $colors = ['image'=>'#16a34a','video'=>'#9333ea','audio'=>'#ca8a04','document'=>'#2563eb','other'=>'#64748b'];
                    @endphp
                    <i class="fa-solid {{ $m->material_icon }}" style="color:{{ $colors[$m->material_type] ?? '#64748b' }};font-size:1.2rem"></i>
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="fw-500">{{ $m->title }}</div>
                    @if($m->description)
                        <div class="text-muted small">{{ Str::limit($m->description,80) }}</div>
                    @endif
                    <div class="d-flex gap-2 mt-1 flex-wrap">
                        <span class="badge badge-{{ $m->status_badge }}">{{ $m->status_label }}</span>
<span class="badge badge-info">{{ ucfirst($m->material_type) }}</span>
                        <span class="text-muted" style="font-size:.75rem">
                            <i class="fa-solid fa-file me-1"></i>{{ $m->file_name }}
                        </span>
                        <span class="text-muted" style="font-size:.75rem">
                            <i class="fa-solid fa-weight-hanging me-1"></i>{{ $m->file_size_human }}
                        </span>
                        <span class="text-muted" style="font-size:.75rem">
                            <i class="fa-regular fa-calendar me-1"></i>{{ $m->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
                <form action="{{ route('trainer.materials.destroy', [$session, $m]) }}" method="POST"
                    onsubmit="return confirm('Delete this material?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger flex-shrink-0" title="Delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
            @empty
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-folder-open fa-2x mb-2 d-block text-muted opacity-50"></i>
                No materials uploaded yet. Use the form to upload your first file.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('fileInput').addEventListener('change', function() {
    const info  = document.getElementById('fileInfo');
    const fname = document.getElementById('fileName');
    const fsize = document.getElementById('fileSize');
    if (this.files.length) {
        const file = this.files[0];
        const mb   = (file.size / 1048576).toFixed(2);
        fname.textContent = file.name;
        fsize.textContent = mb + ' MB';
        info.classList.remove('d-none');
    }
});
</script>
@endpush
