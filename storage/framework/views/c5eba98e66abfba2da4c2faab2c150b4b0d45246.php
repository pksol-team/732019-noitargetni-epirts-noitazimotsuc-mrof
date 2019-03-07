 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Writer Tips</div>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Writer#</th>
                    <th>Order#</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php foreach($tips as $tip): ?>
                    <?php $assign = $tip->assign ?>
                    <tr>
                        <td><?php echo e($assign->user_id); ?></td>
                        <td><?php echo e($assign->order_id); ?></td>
                        <td>$<?php echo e(number_format($tip->amount*$tip->usd_rate,2)); ?></td>
                        <td><?php echo e(date('Y M d, H:i',strtotime($tip->create_time))); ?></td>
                        <td>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/$assign->order_id/room/$assign->id")); ?>"><i class="fa fa-users"></i> Room</a>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/$assign->order_id")); ?>"><i class="fa fa-eye"></i> Order</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo e($tips->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>