 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Admin Groups</div>
        </div>
        <div class="panel-body">
            <table class="table table-stripped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Users</th>
                    <th>Action</th>
                </tr>
                <?php foreach($admin_groups as $admin_group): ?>
                    <tr>
                        <td><?php echo e($admin_group->id); ?></td>
                        <td><?php echo e($admin_group->name); ?></td>
                        <td><?php echo e($admin_group->description); ?></td>
                        <td><?php echo e(count($admin_group->users)); ?></td>
                        <td>
                            <a class="btn btn-info" href="<?php echo e(URL::to("admin_groups/view/$admin_group->id")); ?>">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <?php echo e($admin_groups->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>