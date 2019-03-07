 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">Orders Under Revision</div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
            <tr class="tabular">
                <th>Order</th>
                <th>Instructions</th>
                <th>Pages</th>
                <th>CPP</th>
                <th>Subject</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            <?php foreach($revision as $assigned): ?>
                <?php
                $now = date('y-m-d H:i:s');
                $deadline = $assigned->deadline;
                $today = date_create($now);
                $end = date_create($deadline);
                $order = $assigned->order()->get()[0];
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
                <tr class="tabular">
                    <td><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></td>
                    <td><?php echo e(substr($order->instructions,0,100)); ?>..</td>
                    <td><?php echo e($order->pages); ?></td>
                    <td><?php echo e(number_format($assigned->amount/$order->pages,2)); ?></td>
                    <td><?php echo e($order->subject->label); ?></td>
                    <td><?php echo $remaining  ?></td>
                    <td>
                        <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("writer/order/$order->id/room/$assigned->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a>
                        <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/writer/order/'.''.$order->id)); ?>"><i class="fa fa-eye fa-fw"></i> View</a>
                    </td>
                </tr>
                <div class="well gridular well-lg col-md-11">
                    <div class="row">
                        <div class="col-sm-7"><strong>Order: </strong>#<?php echo e($order->id); ?> - <?php echo e($order->topic); ?></div>
                        <div class="dropdown pull-right">
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("writer/order/$order->id/room/$assigned->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/writer/order/'.''.$order->id)); ?>"><i class="fa fa-eye fa-fw"></i> View</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                        <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>CPP: </strong><?php echo e(number_format($assigned->amount/$order->pages,2)); ?></div>
                        <div class="col-sm-5"><strong>Remaining Time: </strong><?php echo $remaining  ?></div>
                    </div>

                </div>
                <?php endforeach; ?>
            </table>
                <?php echo e($revision->links()); ?>

            </div>
        </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>