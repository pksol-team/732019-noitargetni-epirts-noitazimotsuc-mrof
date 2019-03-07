 
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><?php echo e($user->name.' Orders'); ?><a class="btn btn-info btn-xs pull-right" href="<?php echo e(URL::to("user/view/client/$user->id")); ?>"><i class="fa fa-user"></i> Profile</a> </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Pages</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>On</th>
                    <th>Action</th>
                </tr>

                <?php foreach($orders as $order): ?>
                    <?php
                    $deadline = Carbon\Carbon::createFromTimestamp(strtotime($order->created_at));
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td><?php echo e(number_format($order->amount,2)); ?></td>
                        <td>
                            <?php if($order->paid): ?>
                                <i style="color:green" class="fa fa-check"></i>
                            <?php else: ?>
                                <i style="color: red" class="fa fa-times"></i>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($deadline->diffForHumans()); ?></td>
                        <th>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>

                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                            <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Placed: </strong><?php echo e($deadline->diffForHumans()); ?></div>
                            <div class="col-sm-2"><strong>Amount: </strong><?php echo e(number_format($order->amount,2)); ?></div>
                            <div class="col-sm-2"><strong>Paid: </strong><?php if($order->paid): ?>
                                    <i style="color:green" class="fa fa-check"></i>
                                <?php else: ?>
                                    <i style="color: red" class="fa fa-times"></i>
                                <?php endif; ?></div>
                        </div>

                    </div>

                <?php endforeach; ?>
                <?php echo e($orders->links()); ?>

            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>