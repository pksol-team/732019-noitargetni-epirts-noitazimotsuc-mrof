 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Orders open for Bidding </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Pages</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Bid Amt</th>
                    <th>Bids</th>
                    <th>Client Deadline</th>
                    <th>Bid Deadline</th>
                    <th>Action</th>
                </tr>

                <?php foreach($bidmappers as $bidmapper): ?>
                    <?php
                    $order = $bidmapper->order;
                    $now = date('y-m-d H:i:s');
                    $deadline = $order->deadline;
                    $today = date_create($now);
                    $end = date_create($deadline);
                    $diff = date_diff($today,$end);
                    if($today>$end){
                        if($diff->d){
                            $remaining = '<span style="color: red;">Late: '.$diff->d.' Day(s) '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }else{
                            $remaining = '<span style="color: red;">Late: '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }
                    }else{

                        if($diff->d){
                            $remaining = '<span style="color: darkgreen;">'.$diff->d.' Day(s) '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }else{
                            $remaining = '<span style="color: darkgreen;">'.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }
                    }

                    ?>
                    <?php
                        $order = $bidmapper->order;
                        $b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($bidmapper->deadline));

                    $c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));


                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td><?php echo e(number_format($order->amount,2)); ?></td>
                        <td><?php if($order->paid): ?>
                                <i style="color:green" class="fa fa-check"></i>
                            <?php else: ?>
                                <i style="color: red" class="fa fa-times"></i>
                            <?php endif; ?></td>
                        <td>
                            <?php if($bidmapper->bid_amount): ?>
                                <?php echo e(number_format($bidmapper->bid_amount,2)); ?>

                            <?php else: ?>
                                Default
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(count($order->bids()->get())); ?></td>
                        <td><?php echo $remaining; ?></td>
                        <td>
                            <?php if($bidmapper->deadline != '0000-00-00 00:00:00'): ?>
                                <?php echo e($b_deadline->diffForHumans()); ?>

                                <?php else: ?>
                                Default
                                <?php endif; ?>

                        </td>
                        <th>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/activate/$bidmapper->id")); ?>"><i class="fa fa-edit"></i> Edit Bid</a>
                            <?php if(Auth::user()->isAllowedTo('enable_take')): ?>
                                <?php if($bidmapper->allow_take): ?>
                                <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to("order/enable_take/$bidmapper->id")); ?>"><i class="fa fa-thumbs-up"></i> Edit Take</a>
                                <?php else: ?>
                                <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to("order/enable_take/$bidmapper->id")); ?>"><i class="fa fa-thumbs-up"></i> Enable Take</a>
                                    <?php endif; ?>
                            <?php endif; ?>
                            <a onclick="return confirm('Are you sure?');" class="btn btn-danger btn-xs" href="<?php echo e(URL::to("order/deactivate/$bidmapper->id")); ?>"><i class="fa fa-times"></i> Deactivate</a>
                            <?php if(Auth::user()->isAllowedTo('delete_data')): ?>
                                <a onclick="return confirm('Delete order <?php echo e($order->id); ?> ?\n All items and info associated with order will be permanently deleted!')" href="<?php echo e(URL::to("order/delete/$order->id")); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php endif; ?>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-sm" href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                                <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/activate/$bidmapper->id")); ?>"><i class="fa fa-edit"></i> Edit Bid</a>

                                <a onclick="return confirm('Are you sure?');" class="btn btn-danger btn-xs" href="<?php echo e(URL::to("order/deactivate/$bidmapper->id")); ?>"><i class="fa fa-times"></i> Deactivate</a>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                            <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Client Deadline: </strong><?php echo e(date('d M Y, h:i a',strtotime($order->created_at))); ?></div>
                            <div class="col-sm-2"><strong>Bid Deadline: </strong> <?php if($bidmapper->deadline != '0000-00-00 00:00:00'): ?>
                                    <?php echo e($b_deadline->diffForHumans()); ?>

                                <?php else: ?>
                                    Default
                                <?php endif; ?></div>
                            <div class="col-sm-2"><strong>Bids: </strong><?php echo e(count($order->bids()->get())); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Paid:</strong>
                                <?php if($order->paid): ?>
                                    <i style="color:green" class="fa fa-check"></i>
                                <?php else: ?>
                                    <i style="color: red" class="fa fa-times"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php echo e($bidmappers->links()); ?>

            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>