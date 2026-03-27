
<?php $__env->startSection('title', 'Create Report'); ?>
<?php $__env->startSection('page-title', 'Generate New Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex align-items-center mb-4">
                <i class="fa-solid fa-chart-line fa-2x text-primary me-3"></i>
                <div>
                    <h5 class="mb-1 fw-700">Generate Report</h5>
                    <p class="text-muted mb-0">Select report type and title to generate detailed analytics.</p>
                </div>
            </div>

            <form action="<?php echo e(route('admin.reports.generate')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-600">Report Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="">Choose report type...</option>
                            <option value="summary">📊 Dashboard Summary</option>
                            <option value="users">👥 Users Overview</option>
                            <option value="sessions">📅 Sessions Analysis</option>
                            <option value="enrollments">📋 Enrollments Report</option>
                            <option value="materials">📚 Materials Library</option>
                        </select>
                        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600">Report Title *</label>
                        <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="e.g. Monthly User Activity Summary" value="<?php echo e(old('title')); ?>" required>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                    <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Reports
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-magic me-2"></i> Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views\admin\reports\create.blade.php ENDPATH**/ ?>