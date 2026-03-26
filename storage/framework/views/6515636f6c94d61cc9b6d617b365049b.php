<?php $__env->startSection('title','Manage Materials'); ?>
<?php $__env->startSection('page-title','Manage Materials'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-700 mb-3"><i class="fa-solid fa-cloud-arrow-up me-2 text-primary"></i>Upload Material</h6>
            <p class="small text-muted mb-3">Session: <strong><?php echo e($session->title); ?></strong></p>
            <form action="<?php echo e(route('trainer.materials.store', $session)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-600 small">Title *</label>
                    <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('title')); ?>" placeholder="e.g. Week 1 Slides" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-600 small">Description</label>
                    <textarea name="description" class="form-control" rows="2"
                        placeholder="Brief description…"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-600 small">File * <span class="text-muted">(max 100MB)</span></label>
                    <input type="file" name="file" id="fileInput"
                        class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt,.png,.jpg,.jpeg,.gif,.mp4,.avi,.mov,.mp3,.zip,.rar"
                        required>
                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div id="fileInfo" class="mt-2 small text-muted d-none">
                        <i class="fa-solid fa-file me-1"></i><span id="fileName"></span>
                        — <span id="fileSize"></span>
                    </div>
                </div>

                
                <div class="bg-light rounded p-2 mb-3" style="font-size:.75rem">
                    <strong>Accepted:</strong> PDF, Word, PPT, Excel, Images (PNG/JPG/GIF), Videos (MP4/AVI/MOV), Audio (MP3), ZIP/RAR
                </div>

                <button type="submit" class="btn btn-primary text-white w-100">
                    <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>Upload Material
                </button>
            </form>
        </div>
    </div>

    
    <div class="col-lg-8">
        <div class="table-card">
            <div class="table-header">
                <strong>Materials in "<?php echo e($session->title); ?>" (<?php echo e($materials->count()); ?>)</strong>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width:44px;height:44px;flex-shrink:0;background:#f1f5f9">
                    <?php
                    $colors = ['image'=>'#16a34a','video'=>'#9333ea','audio'=>'#ca8a04','document'=>'#2563eb','other'=>'#64748b'];
                    ?>
                    <i class="fa-solid <?php echo e($m->material_icon); ?>" style="color:<?php echo e($colors[$m->material_type] ?? '#64748b'); ?>;font-size:1.2rem"></i>
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="fw-500"><?php echo e($m->title); ?></div>
                    <?php if($m->description): ?>
                        <div class="text-muted small"><?php echo e(Str::limit($m->description,80)); ?></div>
                    <?php endif; ?>
                    <div class="d-flex gap-2 mt-1 flex-wrap">
                        <span class="badge badge-<?php echo e($m->status_badge); ?>"><?php echo e($m->status_label); ?></span>
<span class="badge badge-info"><?php echo e(ucfirst($m->material_type)); ?></span>
                        <span class="text-muted" style="font-size:.75rem">
                            <i class="fa-solid fa-file me-1"></i><?php echo e($m->file_name); ?>

                        </span>
                        <span class="text-muted" style="font-size:.75rem">
                            <i class="fa-solid fa-weight-hanging me-1"></i><?php echo e($m->file_size_human); ?>

                        </span>
                        <span class="text-muted" style="font-size:.75rem">
                            <i class="fa-regular fa-calendar me-1"></i><?php echo e($m->created_at->format('d M Y')); ?>

                        </span>
                    </div>
                </div>
                <form action="<?php echo e(route('trainer.materials.destroy', [$session, $m])); ?>" method="POST"
                    onsubmit="return confirm('Delete this material?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger flex-shrink-0" title="Delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-folder-open fa-2x mb-2 d-block text-muted opacity-50"></i>
                No materials uploaded yet. Use the form to upload your first file.
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/trainer/sessions/materials.blade.php ENDPATH**/ ?>