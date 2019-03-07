 
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Orders not open to bidding </div>
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
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                <?php foreach($bidmappers as $bidmapper): ?>
                    <?php
                    $order = $bidmapper->order;
                      if(!$order){
                          $bidmapper->delete();
                      }
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
                        $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td>
                            <?php if($order->amount<1): ?>
                                <strong style="color:green;">Pending</strong>
                            <?php else: ?>
                            <?php echo e(number_format($order->amount,2)); ?>

                                <?php endif; ?>
                        </td>
                        <td>
                            <?php if($order->paid): ?>
                                <i style="color:green" class="fa fa-check"></i>
                                <?php else: ?>
                                <i style="color: red" class="fa fa-times"></i>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $remaining; ?></td>
                        <th>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            <?php if($order->amount>0): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/activate/$bidmapper->id")); ?>"><i class="fa fa-check"></i> Activate</a>
                            <?php endif; ?>
                                <?php if(Auth::user()->isAllowedTo('delete_data')): ?>
                                <a onclick="return confirm('Delete order <?php echo e($order->id); ?> ?\n All items and info associated with order will be permanently deleted!')" href="<?php echo e(URL::to("order/delete/$order->id")); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php endif; ?>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm-10"><strong>Order: </strong>#<a href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                                <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/activate/$bidmapper->id")); ?>"><i class="fa fa-check"></i> Activate</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                            <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Deadline: </strong><?php echo e($deadline->diffForHumans()); ?></div>
                            <div class="col-sm-2"><strong>Amount: </strong><?php echo e(number_format($order->amount,2)); ?></div>
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