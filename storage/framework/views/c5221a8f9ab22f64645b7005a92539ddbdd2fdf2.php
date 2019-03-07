 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Add New Order</div>
        </div>
        <div class="panel-body">
            <form method="post" action="<?php echo e(URL::to("order/edit/$order->id")); ?>" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="control-label col-md-3">Topic</label>
                    <div class="col-md-5">
                        <input required value="Writer's Choice" type="text" name="topic" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Pages</label>
                    <div class="col-md-2">
                        <input onchange="getOrderCost();" type="number" required min="1" value="<?php echo e($order->pages); ?>" class="form-control" name="pages">
                    </div>
                    <label class="control-label col-md-1">Sources</label>
                    <div class="col-md-2">
                        <input type="number" required min="0" value="<?php echo e($order->sources); ?>" class="form-control" name="sources">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Instructions</label>
                    <div class="col-md-5">
                        <textarea required class="form-control" name="instructions"><?php echo e($order->instructions); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>