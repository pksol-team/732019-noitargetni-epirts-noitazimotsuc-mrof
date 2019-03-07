 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Order Payments</div>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Reference</th>
                    <th>Order#</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php foreach($txns as $txn): ?>
                <?php
                    if(!$txn->order){
                        $txn->delete();
                    }
                 ?>
                    <tr>
                        <td><?php echo e($txn->id); ?></td>
                        <td><?php echo e($txn->txn_id); ?></td>
                        <td><?php echo e($txn->order_id); ?></td>
                        <?php
                    $rate = $txn->usd_rate ? $txn->usd_rate:1;
                                ?>
                        <td>$<?php echo e(number_format($txn->amount*$rate,2)); ?></td>
                        <td><?php echo e($txn->state); ?></td>
                        <td><?php echo e(date('Y M d, H:i',strtotime($txn->create_time))); ?></td>
                        <td>
                            <a href="<?php echo e(URL::to('/order/'.''.$txn->order->id)); ?>" class="btn btn-info btn-xs">View Order</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo e($txns->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>