<?php $__env->startSection('title','Manage Users'); ?>
<?php $__env->startSection('page-title','Manage Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="table-card">
    <div class="table-header flex-wrap gap-2">
        <strong class="fs-6">All Users</strong>
        <div class="d-flex gap-2 flex-wrap">
            
            <form class="d-flex gap-2" method="GET">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name/email…" value="<?php echo e(request('search')); ?>">
                <select name="role" class="form-select form-select-sm" style="width:130px">
                    <option value="">All Roles</option>
                    <option value="admin"   <?php echo e(request('role')=='admin'   ? 'selected':''); ?>>Admin</option>
                    <option value="trainer" <?php echo e(request('role')=='trainer' ? 'selected':''); ?>>Trainer</option>
                    <option value="trainee" <?php echo e(request('role')=='trainee' ? 'selected':''); ?>>Trainee</option>
                </select>
                <button class="btn btn-sm btn-secondary">Filter</button>
            </form>
            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-sm btn-primary text-white">
                <i class="fa-solid fa-plus me-1"></i>Add User
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr>
                <th>#</th><th>Name</th><th>Email</th><th>Role</th>
                <th>Phone</th><th>Status</th><th>Joined</th><th>Actions</th>
            </tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-muted small"><?php echo e($u->id); ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                style="width:34px;height:34px;background:#2563eb;font-size:.8rem;flex-shrink:0">
                                <?php echo e(strtoupper(substr($u->name,0,1))); ?>

                            </div>
                            <span class="fw-500"><?php echo e($u->name); ?></span>
                        </div>
                    </td>
                    <td class="text-muted small"><?php echo e($u->email); ?></td>
                    <td>
                        <?php $rc = ['admin'=>'badge-danger','trainer'=>'badge-info','trainee'=>'badge-warning']; ?>
                        <span class="badge <?php echo e($rc[$u->role] ?? 'badge-secondary'); ?>"><?php echo e(ucfirst($u->role)); ?></span>
                    </td>
                    <td class="text-muted small"><?php echo e($u->phone ?? '—'); ?></td>
                    <td>
                        <?php if($u->is_active): ?>
                            <span class="badge badge-success">Active</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-muted small"><?php echo e($u->created_at->format('d M Y')); ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.users.edit',$u)); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="<?php echo e(route('admin.users.toggle',$u)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button class="btn btn-sm <?php echo e($u->is_active ? 'btn-outline-warning' : 'btn-outline-success'); ?>"
                                    title="<?php echo e($u->is_active ? 'Deactivate' : 'Activate'); ?>">
                                    <i class="fa-solid <?php echo e($u->is_active ? 'fa-ban' : 'fa-check'); ?>"></i>
                                </button>
                            </form>
                            <?php if($u->id !== auth()->id()): ?>
                            <form action="<?php echo e(route('admin.users.destroy',$u)); ?>" method="POST"
                                onsubmit="return confirm('Delete <?php echo e($u->name); ?>? This cannot be undone.')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center text-muted py-5">No users found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($users->hasPages()): ?>
        <div class="p-3"><?php echo e($users->withQueryString()->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/admin/users/index.blade.php ENDPATH**/ ?>