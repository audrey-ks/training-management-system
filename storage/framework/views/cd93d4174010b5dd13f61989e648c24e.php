<?php $__env->startSection('title', $session->title); ?>
<?php $__env->startSection('page-title', 'Session Detail'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-lg-8">
        <div class="form-card mb-3">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="fw-700 mb-1"><?php echo e($session->title); ?></h5>
                    <span class="badge <?php echo e($session->status_badge); ?> me-2"><?php echo e(ucfirst($session->status)); ?></span>
                    <?php if($session->location): ?>
                        <span class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i><?php echo e($session->location); ?></span>
                    <?php endif; ?>
                </div>
                <a href="<?php echo e(route('trainee.sessions.index')); ?>" class="btn btn-sm btn-outline-secondary">Back</a>
            </div>
            <p class="text-muted"><?php echo e($session->description ?? 'No description provided.'); ?></p>
            <div class="row g-2">
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Trainer</div>
                        <div class="fw-600 small"><?php echo e($session->trainer->name ?? 'N/A'); ?></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Start</div>
                        <div class="fw-600 small"><?php echo e($session->start_date->format('d M Y')); ?></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">End</div>
                        <div class="fw-600 small"><?php echo e($session->end_date->format('d M Y')); ?></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Spots Left</div>
                        <div class="fw-600 small"><?php echo e(max(0,$session->max_trainees - $session->enrollments()->count())); ?></div>
                    </div>
                </div>
            </div>

            <?php if(!$enrolled): ?>
                <form action="<?php echo e(route('trainee.sessions.enroll',$session)); ?>" method="POST" class="mt-3">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary text-white">
                        <i class="fa-solid fa-pen-to-square me-2"></i>Enroll in this Session
                    </button>
                </form>
            <?php else: ?>
                <div class="alert alert-success mt-3 mb-0 py-2 small">
                    <i class="fa-solid fa-circle-check me-2"></i>You are enrolled — status: <strong><?php echo e(ucfirst($enrolled->status)); ?></strong>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="table-card">
            <div class="table-header">
                <strong>Session Materials (<?php echo e($materials->count()); ?>)</strong>
                <?php if(!$enrolled): ?>
                    <span class="badge badge-warning small">Enroll to download</span>
                <?php endif; ?>
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
                        <div class="text-muted small"><?php echo e($m->description); ?></div>
                    <?php endif; ?>
                    <div class="d-flex gap-2 mt-1 flex-wrap">
                        <span class="badge badge-info"><?php echo e(ucfirst($m->material_type)); ?></span>
                        <span class="text-muted" style="font-size:.75rem"><?php echo e($m->file_size_human); ?></span>
                        <span class="text-muted" style="font-size:.75rem"><?php echo e($m->created_at->format('d M Y')); ?></span>
                    </div>
                </div>
                <?php if($enrolled): ?>
                    <a href="<?php echo e(route('trainee.materials.download',[$session,$m])); ?>"
                        class="btn btn-sm btn-outline-success flex-shrink-0">
                        <i class="fa-solid fa-download"></i>
                    </a>
                <?php else: ?>
                    <button class="btn btn-sm btn-outline-secondary flex-shrink-0" disabled title="Enroll first">
                        <i class="fa-solid fa-lock"></i>
                    </button>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-folder-open fa-2x mb-2 d-block opacity-30"></i>
                No materials have been uploaded yet.
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-700 mb-3">Session Info</h6>
            <ul class="list-unstyled" style="font-size:.875rem">
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Status</span>
                    <span class="badge <?php echo e($session->status_badge); ?>"><?php echo e(ucfirst($session->status)); ?></span>
                </li>
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Trainer</span>
                    <span><?php echo e($session->trainer->name ?? 'TBD'); ?></span>
                </li>
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Duration</span>
                    <span><?php echo e($session->start_date->diffInDays($session->end_date) + 1); ?> days</span>
                </li>
                <li class="py-2 border-bottom d-flex justify-content-between">
                    <span class="text-muted">Enrolled</span>
                    <span><?php echo e($session->enrollments()->count()); ?> / <?php echo e($session->max_trainees); ?></span>
                </li>
                <li class="py-2 d-flex justify-content-between">
                    <span class="text-muted">Materials</span>
                    <span><?php echo e($materials->count()); ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/trainee/sessions/show.blade.php ENDPATH**/ ?>