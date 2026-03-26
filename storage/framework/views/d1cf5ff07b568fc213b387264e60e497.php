<?php $__env->startSection('title','Admin Dashboard'); ?>
<?php $__env->startSection('page-title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
    <?php
    $cards = [
        ['label'=>'Total Users',    'value'=>$stats['total_users'],    'icon'=>'fa-users',          'color'=>'#dbeafe','ic'=>'#2563eb'],
        ['label'=>'Trainers',       'value'=>$stats['total_trainers'], 'icon'=>'fa-chalkboard-user','color'=>'#dcfce7','ic'=>'#16a34a'],
        ['label'=>'Trainees',       'value'=>$stats['total_trainees'], 'icon'=>'fa-user-graduate',  'color'=>'#fef9c3','ic'=>'#ca8a04'],
        ['label'=>'Total Sessions', 'value'=>$stats['total_sessions'], 'icon'=>'fa-calendar-days',  'color'=>'#f3e8ff','ic'=>'#9333ea'],
        ['label'=>'Active Sessions','value'=>$stats['active_sessions'],'icon'=>'fa-circle-play',    'color'=>'#dcfce7','ic'=>'#16a34a'],
        ['label'=>'Enrollments',    'value'=>$stats['total_enrolls'],  'icon'=>'fa-clipboard-list', 'color'=>'#ffedd5','ic'=>'#ea580c'],
        ['label'=>'Materials',      'value'=>$stats['total_materials'],'icon'=>'fa-file-arrow-up',  'color'=>'#e0f2fe','ic'=>'#0284c7'],
    ];
    ?>

    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:<?php echo e($c['color']); ?>">
                <i class="fa-solid <?php echo e($c['icon']); ?>" style="color:<?php echo e($c['ic']); ?>"></i>
            </div>
            <div class="value"><?php echo e($c['value']); ?></div>
            <div class="label"><?php echo e($c['label']); ?></div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="row g-3">
    
    <div class="col-lg-7">
        <div class="table-card">
            <div class="table-header">
                <strong>Recent Sessions</strong>
                <a href="<?php echo e(route('admin.sessions.index')); ?>" class="btn btn-sm btn-primary text-white">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr>
                        <th>Title</th><th>Trainer</th><th>Status</th><th>Start</th>
                    </tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('admin.sessions.show',$s)); ?>" class="text-decoration-none fw-500"><?php echo e($s->title); ?></a></td>
                            <td><?php echo e($s->trainer->name ?? '—'); ?></td>
                            <td><span class="badge <?php echo e($s->status_badge); ?>"><?php echo e(ucfirst($s->status)); ?></span></td>
                            <td class="text-muted small"><?php echo e($s->start_date->format('d M Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">No sessions yet</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="col-lg-5">
        <div class="table-card">
            <div class="table-header">
                <strong>Recent Users</strong>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-sm btn-primary text-white">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Name</th><th>Role</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="fw-500"><?php echo e($u->name); ?></div>
                                <div class="text-muted" style="font-size:.75rem"><?php echo e($u->email); ?></div>
                            </td>
                            <td><span class="badge badge-info"><?php echo e(ucfirst($u->role)); ?></span></td>
                            <td>
                                <?php if($u->is_active): ?>
                                    <span class="badge badge-success">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="text-center text-muted py-4">No users yet</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>