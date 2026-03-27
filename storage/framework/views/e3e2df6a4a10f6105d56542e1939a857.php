<?php $__env->startSection('title','Browse Sessions'); ?>
<?php $__env->startSection('page-title','Available Sessions'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
<?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-md-6 col-xl-4">
        <div class="stat-card h-100 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge <?php echo e($s->status_badge); ?>"><?php echo e(ucfirst($s->status)); ?></span>
                <?php if($enrolled->contains($s->id)): ?>
                    <span class="badge badge-success"><i class="fa-solid fa-check me-1"></i>Enrolled</span>
                <?php endif; ?>
            </div>
            <h6 class="fw-700 mb-1"><?php echo e($s->title); ?></h6>
            <p class="text-muted small flex-grow-1"><?php echo e(Str::limit($s->description, 100)); ?></p>

            <div class="d-flex flex-column gap-1 my-2" style="font-size:.8rem">
                <?php if($s->trainer): ?>
                    <span><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i><?php echo e($s->trainer->name); ?></span>
                <?php endif; ?>
                <span><i class="fa-regular fa-calendar me-2 text-primary"></i><?php echo e($s->start_date->format('d M')); ?> — <?php echo e($s->end_date->format('d M Y')); ?></span>
                <?php if($s->location): ?>
                    <span><i class="fa-solid fa-location-dot me-2 text-primary"></i><?php echo e($s->location); ?></span>
                <?php endif; ?>
                <span><i class="fa-solid fa-users me-2 text-primary"></i><?php echo e($s->enrollments_count); ?> / <?php echo e($s->max_trainees); ?> trainees</span>
                <span><i class="fa-solid fa-file me-2 text-primary"></i><?php echo e($s->materials_count); ?> materials</span>
            </div>

            <a href="<?php echo e(route('trainee.sessions.show',$s)); ?>" class="btn btn-primary btn-sm text-white mt-2">
                <i class="fa-solid fa-eye me-1"></i>View Details
            </a>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12 text-center text-muted py-5">No sessions available.</div>
<?php endif; ?>
</div>

<?php if($sessions->hasPages()): ?>
    <div class="mt-4"><?php echo e($sessions->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views\trainee\sessions\index.blade.php ENDPATH**/ ?>