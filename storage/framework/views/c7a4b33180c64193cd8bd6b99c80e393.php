<?php $__env->startSection('title','My Dashboard'); ?>
<?php $__env->startSection('page-title','My Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
    <?php $__currentLoopData = [
        ['Enrolled',  $stats['enrolled'],  'fa-clipboard-list', '#dbeafe','#2563eb'],
        ['Active',    $stats['active'],    'fa-circle-play',    '#dcfce7','#16a34a'],
        ['Completed', $stats['completed'], 'fa-badge-check',    '#f3e8ff','#9333ea'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$lbl,$val,$icon,$bg,$ic]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-4">
        <div class="stat-card">
            <div class="icon" style="background:<?php echo e($bg); ?>">
                <i class="fa-solid <?php echo e($icon); ?>" style="color:<?php echo e($ic); ?>"></i>
            </div>
            <div class="value"><?php echo e($val); ?></div>
            <div class="label"><?php echo e($lbl); ?></div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="table-card">
    <div class="table-header">
        <strong>My Enrolled Sessions</strong>
        <a href="<?php echo e(route('trainee.sessions.index')); ?>" class="btn btn-sm btn-primary text-white">
            <i class="fa-solid fa-search me-1"></i>Browse All Sessions
        </a>
    </div>
    <div class="row g-0">
    <?php $__empty_1 = true; $__currentLoopData = $enrolledSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12 border-bottom p-3">
            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                <div>
                    <div class="fw-500 mb-1"><?php echo e($s->title); ?></div>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge <?php echo e($s->status_badge); ?>"><?php echo e(ucfirst($s->status)); ?></span>
                        <span class="text-muted small"><i class="fa-solid fa-calendar me-1"></i><?php echo e($s->start_date->format('d M')); ?> — <?php echo e($s->end_date->format('d M Y')); ?></span>
                        <span class="text-muted small"><i class="fa-solid fa-file me-1"></i><?php echo e($s->materials_count); ?> materials</span>
                        <?php if($s->trainer): ?>
                            <span class="text-muted small"><i class="fa-solid fa-chalkboard-user me-1"></i><?php echo e($s->trainer->name); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?php echo e(route('trainee.sessions.show',$s)); ?>" class="btn btn-sm btn-outline-primary flex-shrink-0">
                    <i class="fa-solid fa-eye me-1"></i>View & Download
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center text-muted py-5">
            <i class="fa-solid fa-graduation-cap fa-2x mb-3 d-block opacity-30"></i>
            You are not enrolled in any sessions yet.
            <a href="<?php echo e(route('trainee.sessions.index')); ?>" class="d-block mt-2">Browse available sessions</a>
        </div>
    <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/trainee/dashboard.blade.php ENDPATH**/ ?>