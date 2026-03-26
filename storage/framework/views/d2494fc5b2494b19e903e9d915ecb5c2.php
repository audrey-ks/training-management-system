<?php $__env->startSection('title','Edit User'); ?>
<?php $__env->startSection('page-title','Edit User'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 fw-700"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Edit: <?php echo e($user->name); ?></h5>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>

            <form action="<?php echo e(route('admin.users.update',$user)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Full Name *</label>
                        <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('name',$user->name)); ?>" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Email Address *</label>
                        <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('email',$user->email)); ?>" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Role *</label>
                        <select name="role" class="form-select" required>
                            <option value="admin"   <?php echo e(old('role',$user->role)=='admin'   ? 'selected':''); ?>>Admin</option>
                            <option value="trainer" <?php echo e(old('role',$user->role)=='trainer' ? 'selected':''); ?>>Trainer</option>
                            <option value="trainee" <?php echo e(old('role',$user->role)=='trainee' ? 'selected':''); ?>>Trainee</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone',$user->phone)); ?>">
                    </div>
                    <div class="col-12"><hr class="my-1"><p class="small text-muted mb-2">Leave password blank to keep unchanged.</p></div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="New password (optional)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-600 small">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary text-white px-4">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
                    </button>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>