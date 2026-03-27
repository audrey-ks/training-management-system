<?php $__env->startSection('title','Trainer Dashboard'); ?>
<?php $__env->startSection('page-title','My Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
    <?php $__currentLoopData = [
        ['My Sessions',   $stats['total_sessions'],  'fa-calendar-days',  '#dbeafe','#2563eb'],
        ['Active',        $stats['active_sessions'],  'fa-circle-play',    '#dcfce7','#16a34a'],
        ['Materials',     $stats['total_materials'],  'fa-file-arrow-up',  '#f3e8ff','#9333ea'],
        ['Total Trainees',$stats['total_trainees'],   'fa-user-graduate',  '#fef9c3','#ca8a04'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$lbl,$val,$icon,$bg,$ic]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-3">
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
    <div class="table-header"><strong>My Assigned Sessions</strong></div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr>
                <th>Session</th><th>Dates</th><th>Status</th>
                <th>Trainees</th><th>Materials</th><th>Actions</th>
            </tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="fw-500"><?php echo e($s->title); ?></div>
                        <div class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i><?php echo e($s->location ?? 'N/A'); ?></div>
                    </td>
                    <td class="small text-muted">
                        <?php echo e($s->start_date->format('d M')); ?> — <?php echo e($s->end_date->format('d M Y')); ?>

                    </td>
                    <td><span class="badge <?php echo e($s->status_badge); ?>"><?php echo e(ucfirst($s->status)); ?></span></td>
                    <td class="text-center small"><?php echo e($s->enrollments_count); ?></td>
                    <td class="text-center small"><?php echo e($s->materials_count); ?></td>
                    <td>
                        <a href="<?php echo e(route('trainer.sessions.materials',$s)); ?>" class="btn btn-sm btn-primary text-white">
                            <i class="fa-solid fa-file-arrow-up me-1"></i>Manage Materials
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-muted py-5">No sessions assigned to you yet.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views\trainer\dashboard.blade.php ENDPATH**/ ?>