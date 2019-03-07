 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Orders Under Revision
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="">
                    <th>Order</th>
                    <th>Pages</th>
                    <th>Subject</th>
                    <th>On</th>
                    <th>Writer</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                <?php foreach($assigns as $assigned): ?>
                    <?php
                    $now = date('y-m-d H:i:s');
                    $deadline = $assigned->deadline;
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
                     $order = $assigned->order;

                    ?>
                    <tr class="tadfbular">
                        <td><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e(date('d M Y, h:i a',strtotime($assigned->updated_at))); ?></td>
                        <td><a target="_blank" href="<?php echo e(URL::to("order/writer".'/'.$assigned->user->id)); ?>"><?php echo e($assigned->user->name); ?></a></td>
                        <td><?php echo $remaining; ?> </td>
                        <td><a href="<?php echo e(URL::to("/order/$order->id/room/$assigned->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a></td>
                    </tr>
            <?php endforeach; ?>
            </table>
            <?php echo $assigns->links(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>