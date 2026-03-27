<?php $__env->startSection('title', $session->title); ?>
<?php $__env->startSection('page-title', 'Session Detail'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-lg-8">
        <div class="form-card mb-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="fw-700 mb-1"><?php echo e($session->title); ?></h5>
                    <span class="badge <?php echo e($session->status_badge); ?> me-2"><?php echo e(ucfirst($session->status)); ?></span>
                    <span class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i><?php echo e($session->location ?? 'N/A'); ?></span>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?php echo e(route('admin.sessions.edit',$session)); ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>
                    <a href="<?php echo e(route('admin.sessions.index')); ?>" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
            </div>
            <p class="text-muted"><?php echo e($session->description ?? 'No description provided.'); ?></p>
            <div class="row g-2 mt-1">
                <div class="col-6 col-md-3">
                    <div class="p-2 bg-light rounded text-center">
                        <div class="small text-muted">Trainer</div>
                        <div class="fw-600 small"><?php echo e($session->trainer->name ?? 'Unassigned'); ?></div>
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
                        <div class="small text-muted">Capacity</div>
                        <div class="fw-600 small"><?php echo e($session->trainees->count()); ?> / <?php echo e($session->max_trainees); ?></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="table-card">
            <div class="table-header"><strong>Materials (<?php echo e($session->materials->count()); ?>)</strong></div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
<th>Title</th><th>Status</th><th>Type</th><th>Size</th><th>Uploaded</th><th>Actions</th>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $session->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><i class="fa-solid <?php echo e($m->material_icon); ?> me-2 text-primary"></i><?php echo e($m->title); ?></td>
                            <td><span class="badge badge-<?php echo e($m->status_badge); ?>"><?php echo e($m->status_label); ?></span></td>
                            <td><span class="badge badge-info"><?php echo e(ucfirst($m->material_type)); ?></span></td>
                            <td class="small text-muted"><?php echo e($m->file_size_human); ?></td>
                            <td class="small"><?php echo e($m->uploader->name ?? '—'); ?></td>
                            <td>
                                <?php if($m->status === 'pending'): ?>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-warning dropdown-toggle" data-bs-toggle="dropdown">
                                            Review
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="<?php echo e(route('admin.sessions.materials.approve', [$session, $m])); ?>" method="POST" style="display:inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-check text-success me-1"></i>Approve
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.sessions.materials.reject', [$session, $m])); ?>" method="POST" style="display:inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Reject?')">
                                                        <i class="fa-solid fa-xmark me-1"></i>Reject
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">No materials uploaded yet.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="table-card">
            <div class="table-header"><strong>Enrolled Trainees (<?php echo e($session->trainees->count()); ?>)</strong></div>
            <ul class="list-group list-group-flush">
            <?php $__empty_1 = true; $__currentLoopData = $session->trainees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item d-flex align-items-center gap-2 py-2">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width:30px;height:30px;font-size:.75rem;font-weight:700;flex-shrink:0">
                        <?php echo e(strtoupper(substr($t->name,0,1))); ?>

                    </div>
                    <div>
                        <div class="fw-500 small"><?php echo e($t->name); ?></div>
                        <div class="text-muted" style="font-size:.72rem"><?php echo e($t->email); ?></div>
                    </div>
                    <span class="badge ms-auto <?php echo e($t->pivot->status=='completed' ? 'badge-success' : 'badge-info'); ?>">
                        <?php echo e(ucfirst($t->pivot->status)); ?>

                    </span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item text-center text-muted py-4">No trainees enrolled.</li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views\admin\sessions\show.blade.php ENDPATH**/ ?>