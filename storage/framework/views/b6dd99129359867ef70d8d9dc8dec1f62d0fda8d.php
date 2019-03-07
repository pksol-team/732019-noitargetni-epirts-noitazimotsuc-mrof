 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Payments</div>
        </div>
        <div class="panel-body">
            <?php echo $__env->make('writer.acc_payments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h3>Order History</h3>
            <div class="row"></div>
            <table class="table">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Pages</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Bonus</th>
                    <th>Fine</th>
                    <th>Rating(/5)</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($assigns as $assign): ?>
                    <tr>
                        <td><?php echo e($assign->order_id.' '.trim($assign->topic)); ?></td>
                        <td><?php echo e($assign->pages); ?></td>
                        <td><?php echo e(date('d, M Y',strtotime($assign->deadline))); ?></td>
                        <td>
                            <?php if($assign->status == 4 && $assign->order_status == 6): ?>
                                <i class="fa fa-check green"></i> Approved
                                <?php elseif($assign->status == 3): ?>
                                <i class="fa fa-lock" style="color:yellow"></i> Proofreading
                                <?php elseif($assign->status == 4): ?>
                                <i class="fa fa-warning"></i> Pending
                                <?php elseif($assign->status == 7): ?>
                                <i class="fa fa-times"></i> Cancelled
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(@number_format($assign->amount,2)); ?></td>
                        <td><?php echo e(@number_format($assign->bonus,2)); ?></td>
                        <td><?php echo e(@number_format($assign->fines()->sum('amount'),2)); ?></td>
                        <td>
                            <?php if($assign->rating && $assign->order_status == 6): ?>
                                <input style="font-size: small;" id="input-2" value="<?php echo e($assign->rating); ?>" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1">
                            <?php else: ?>
                                --
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("writer/order/$assign->order_id/room/$assign->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/writer/order/'.''.$assign->order_id)); ?>"><i class="fa fa-eye fa-fw"></i> View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo e($assigns->links()); ?>

        </div>
    </div>
    <script type="text/javascript">
        $('.rating').rating({displayOnly: true, step: 0.5});
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>