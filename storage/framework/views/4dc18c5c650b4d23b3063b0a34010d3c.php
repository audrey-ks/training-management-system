<?php $__env->startSection('title','Training Sessions'); ?>
<?php $__env->startSection('page-title','Training Sessions'); ?>

<?php $__env->startSection('content'); ?>
<div class="table-card">
    <div class="table-header flex-wrap gap-2">
        <strong class="fs-6">All Sessions</strong>
        <div class="d-flex gap-2 flex-wrap">
            <form class="d-flex gap-2" method="GET">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search title…" value="<?php echo e(request('search')); ?>">
                <select name="status" class="form-select form-select-sm" style="width:140px">
                    <option value="">All Status</option>
                    <?php $__currentLoopData = ['upcoming','active','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php echo e(request('status')==$s ? 'selected':''); ?>><?php echo e(ucfirst($s)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button class="btn btn-sm btn-secondary">Filter</button>
            </form>
            <a href="<?php echo e(route('admin.sessions.create')); ?>" class="btn btn-sm btn-primary text-white">
                <i class="fa-solid fa-plus me-1"></i>New Session
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr>
                <th>Title</th><th>Trainer</th><th>Dates</th>
                <th>Status</th><th>Enrolled</th><th>Actions</th>
            </tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="fw-500"><?php echo e($s->title); ?></div>
                        <div class="text-muted small"><?php echo e(Str::limit($s->description,60)); ?></div>
                    </td>
                    <td class="small"><?php echo e($s->trainer->name ?? '<span class="text-muted">Unassigned</span>'); ?></td>
                    <td class="small text-muted">
                        <?php echo e($s->start_date->format('d M')); ?> — <?php echo e($s->end_date->format('d M Y')); ?>

                    </td>
                    <td><span class="badge <?php echo e($s->status_badge); ?>"><?php echo e(ucfirst($s->status)); ?></span></td>
                    <td class="small text-center"><?php echo e($s->enrollments_count ?? $s->enrollments()->count()); ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.sessions.show',$s)); ?>" class="btn btn-sm btn-outline-info" title="View">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.sessions.edit',$s)); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="<?php echo e(route('admin.sessions.destroy',$s)); ?>" method="POST"
                                onsubmit="return confirm('Delete session « <?php echo e($s->title); ?> »?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-muted py-5">No sessions found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($sessions->hasPages()): ?>
        <div class="p-3"><?php echo e($sessions->withQueryString()->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/admin/sessions/index.blade.php ENDPATH**/ ?>