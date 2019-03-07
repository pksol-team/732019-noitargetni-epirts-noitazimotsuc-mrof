 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Pending</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <?php if($website->designer == 1): ?>
                        <th>Category</th>



                        <?php else: ?>
                        <th>Pages</th>
                        <th>Cost</th>
                    <?php endif; ?>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                <?php foreach($orders as $order): ?>
                    <?php
                        $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));

                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <?php if($website->designer == 1): ?>
                            <td><?php echo e($order->document->label); ?></td>
                            <?php else: ?>
                            <td><?php echo e($order->pages); ?></td>
                            <td>
                                <?php if($order->amount<1): ?>
                                    <strong style="color:green;">Pending</strong>
                                <?php else: ?>
                                    <?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?>

                                <?php endif; ?>
                            </td>
                            <?php endif; ?>

                        <td><?php echo e($deadline->diffForHumans()); ?></td>
                        <th>
                            <a class="btn btn-info btn-sm" href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            <?php if($order->amount>0): ?>
                            <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay</a>
                            <?php endif; ?>
                                <a onclick="deleteItem('<?php echo e(URL::to('stud/delete-order')); ?>',<?php echo e($order->id); ?>)" class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i> Discard</a>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-sm" href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                                <?php if($order->amount>0): ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay</a>
                                <?php endif; ?>
                                <a onclick="deleteItem('<?php echo e(URL::to('stud/delete-order')); ?>',<?php echo e($order->id); ?>)" class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i> Discard</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                            <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Deadline: </strong><?php echo e($deadline->diffForHumans()); ?></div>
                            <div class="col-sm-2"><strong>Amount: </strong> <?php if($order->amount<1): ?>
                                    <strong style="color:green;">Pending</strong>
                                <?php else: ?>
                                    <?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?>

                                <?php endif; ?>
                            </div>
                        </div>

                    </div>

            <?php endforeach; ?>
            <?php echo e($orders->links()); ?>

            </table>
        </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>