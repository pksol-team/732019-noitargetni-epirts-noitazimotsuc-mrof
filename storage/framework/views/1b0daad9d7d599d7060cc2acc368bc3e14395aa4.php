 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Suspend <strong><?php echo e($user->name); ?></strong><a class="btn btn-info btn-xs pull-right" href="<?php echo e(URL::to("user/view/client/$user->id")); ?>"><i class="fa fa-user"></i> Profile</a> </div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="<?php echo e(URL::to("user/$user->id/suspend")); ?>">
               <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="control-label col-md-3">Suspension Reason</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="reason" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-warning">Suspend</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>