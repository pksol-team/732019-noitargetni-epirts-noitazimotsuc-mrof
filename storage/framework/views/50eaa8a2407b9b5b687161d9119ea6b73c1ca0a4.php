 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-times fa-2x"></i> Fine Order for Writer <strong><?php echo e($assign->user->name); ?></strong></div>
        <div class="panel-body">
            <form method="post" action="<?php echo e(URL::to("order/fine/$assign->id")); ?>" class="col-md-offset-2 form-horizontal">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="control-label col-md-4">
                        Fine Amount
                    </label>
                    <div class="col-md-4">
                        <input type="text" name="amount" value="" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">
                        Reason
                    </label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="reason"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">
                        &nbsp;
                    </label>
                    <div class="col-md-4">
                       <button type="submit" class="btn btn-success"><i class="fa fa-money"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>