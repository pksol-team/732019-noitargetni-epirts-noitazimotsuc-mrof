 
<?php $__env->startSection('content'); ?>
    <?php $user = Auth::user();
            ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><?php echo e($admin_group->name); ?></div>
        </div>
        <div class="panel-body">
            <div class="alert alert-info">
                <?php echo e($admin_group->description); ?>

                <div class="btn-group pull-right">
                    <a class="btn btn-success" href="<?php echo e(URL::to("admin_groups/add?id=$admin_group->id")); ?>">Edit</a>
                </div>
            </div>
                <div class="row"></div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Users <a id="btn_new" href="#add_user_modal" data-toggle="modal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add</a> </div>
                        <div class="panel-body">
                            <table class="table table-condensed table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <?php if($user->isAllowedTo('change_role')): ?>
                                    <th>Action</th>
                                        <?php endif; ?>
                                </tr>
                                <?php foreach($users = $admin_group->users()->paginate(10) as $user): ?>
                                    <tr>
                                        <td><?php echo e($user->id); ?></td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->phone); ?></td>
                                       <?php if($user->isAllowedTo('change_role')): ?>
                                        <td>
                                            <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to("user/changerole/$user->id")); ?>">Change Role</a>
                                        </td>
                                           <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin_groups.new_user_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>