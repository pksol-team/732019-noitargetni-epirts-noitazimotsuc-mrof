 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">My Bids</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Order#</th>
                    <th>Message</th>
                    <th>Amount</th>
                    <th>Order#</th>
                    <th>On</th>
                    <th>Action</th>
                </tr>

            <?php foreach($bids as $bid): ?>
                <?php
                if(!$bid->order || $bid->order->bidMapper == null){
                        $bid->delete();
                }else{
                    $bidmapper = $bid->order->bidMapper;
                        $order = $bid->order;
                    ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($bid->message); ?></td>
                        <td><?php echo e($bid->amount); ?></td>
                        <td><a href="<?php echo e("order/$bid->order_id"); ?>"><?php echo e($bid->order->topic); ?></a> </td>
                        <td><?php echo e(date('d M Y, h:i a',strtotime($bid->created_at))); ?></td>
                        <th>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/writer/bid/'.''.$bidmapper->id)); ?>"><i class="fa fa-thumbs-o-up"></i> View Bid</a>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/writer/order/'.''.$order->id)); ?>"><i class="fa fa-eye fa-fw"></i> View Order</a>
                            <a class="btn btn-danger btn-xs" onclick="deleteItem('<?php echo e(URL::to('/writer/bid/delete/')); ?>',<?php echo e($bid->id); ?>)"><i class="fa fa-trash fa-fw"></i> Remove</a>
                        </th>
                    </tr>
                    <?php
                    }
                     ?>
                <?php endforeach; ?>
            </table>
            <?php echo e($bids->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>