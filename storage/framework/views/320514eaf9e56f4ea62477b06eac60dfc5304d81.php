<?php $__env->startSection('content'); ?>
    <div class="row"></div>
    <?php
    $user = Auth::user();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Active Orders</div>
        </div>
        <div class="panel-body">
            <a href="<?php echo e(URL::to('stud/new')); ?>" class="btn btn-success btn-xl">New Order</a>
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Status</th>
                    <th>Subject</th>
                    <th>Pages</th>
                    <th>WriterID</th>
                    <th>Cost</th>
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
                        <td>
                            <?php if($order->status==1): ?>
                                <?php echo e((int)$order->percent); ?>% Complete
                                <div class="progress" style="width: 200px !important;">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e((int)$order->percent); ?>%;">
                                        <?php echo e((int)$order->percent); ?>%
                                    </div>
                                </div>
                            <?php else: ?>
                                On Hold
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td>
                            <?php if($assign = $order->assigns()->where('status','<=','4')->first()): ?>
                                <?php echo e($assign->user_id); ?>

                            <?php else: ?>
                                --
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?></td>
                        <td><?php echo e($deadline->diffForHumans()); ?></td>
                        <th><a class="btn btn-info btn-sm" href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a></th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-sm" href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Status: </strong>
                                <?php if($order->status==1): ?>
                                    <?php echo e((int)$order->percent); ?>% Complete
                                    <div class="progress" style="width: 200px !important;">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                             aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e((int)$order->percent); ?>%;">
                                            <?php echo e((int)$order->percent); ?>%
                                        </div>
                                    </div>
                                <?php else: ?>
                                    On Hold
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-3"><strong>WriterID: </strong>
                                <?php if($assign = $order->assigns()->where('status','<=','4')->first()): ?>
                                    <?php echo e($assign->user_id); ?>

                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                            <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Deadline: </strong><?php echo e($deadline->diffForHumans()); ?></div>
                            <div class="col-sm-2"><strong>Cost: </strong><?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?></div>
                        </div>

                    </div>

                <?php endforeach; ?>
            </table>
            <?php echo e($orders->links()); ?>

        </div>
    </div>
    <?php if($website->wallet == 1): ?>
        <?php echo $__env->make('client.e_wallet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('client.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>