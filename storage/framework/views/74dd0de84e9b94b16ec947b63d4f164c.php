<?php $__env->startSection('title','Edit Session'); ?>
<?php $__env->startSection('page-title','Edit Session'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 fw-700"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Edit: <?php echo e($session->title); ?></h5>
                <a href="<?php echo e(route('admin.sessions.index')); ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <form action="<?php echo e(route('admin.sessions.update',$session)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-600 small">Session Title *</label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title',$session->title)); ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-600 small">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?php echo e(old('description',$session->description)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Assign Trainer</label>
                        <select name="trainer_id" class="form-select">
                            <option value="">— Unassigned —</option>
                            <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->id); ?>" <?php echo e(old('trainer_id',$session->trainer_id)==$t->id ? 'selected':''); ?>><?php echo e($t->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo e(old('location',$session->location)); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600 small">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date',$session->start_date->format('Y-m-d'))); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-600 small">End Date *</label>
                        <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date',$session->end_date->format('Y-m-d'))); ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-600 small">Max Trainees</label>
                        <input type="number" name="max_trainees" class="form-control" value="<?php echo e(old('max_trainees',$session->max_trainees)); ?>" min="1">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-600 small">Status</label>
                        <select name="status" class="form-select">
                            <?php $__currentLoopData = ['upcoming','active','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s); ?>" <?php echo e(old('status',$session->status)==$s ? 'selected':''); ?>><?php echo e(ucfirst($s)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary text-white px-4"><i class="fa-solid fa-floppy-disk me-2"></i>Save</button>
                    <a href="<?php echo e(route('admin.sessions.index')); ?>" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/admin/sessions/edit.blade.php ENDPATH**/ ?>