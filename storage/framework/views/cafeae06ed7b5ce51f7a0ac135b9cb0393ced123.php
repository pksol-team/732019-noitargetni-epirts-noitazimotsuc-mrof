 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Pending Orders</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order</th>
                    <th>Pages</th>
                    <th>Subject</th>
                    <th>On</th>
                    <th>Writer</th>
                    <th>Action</th>
                </tr>

                <?php foreach($assigns as $assign): ?>
                    <?php
                        $order = $assign->order;
                    $now = date('y-m-d H:i:s');
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e(date('d M Y, h:i a',strtotime($assign->updated_at))); ?></td>
                        <td><a target="_blank" href="<?php echo e(URL::to("order/writer".'/'.$assign->user->id)); ?>"><?php echo e($assign->user->name); ?></a></td>
                        <td><a class="btn btn-info btn-sm" href="<?php echo e(URL::to("/order/$order->id/room/$assign->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a></td>
                    </tr>
                <div class="well gridular well-lg col-md-12">
                    <div class="row">
                        <div class="col-sm-4"><strong>Order: </strong>#<?php echo e($order->id); ?> - <?php echo e($order->topic); ?></div>
                        <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                        <div class="dropdown pull-right">
                            <a href="<?php echo e(URL::to("/order/$order->id/room/$assign->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Completed on: </strong><?php echo e(date('d M Y, h:i a',strtotime($assign->updated_at))); ?></div>
                        <div class="col-sm-3"><strong>Writer: </strong><a target="_blank" href="<?php echo e(URL::to("order/writer".'/'.$assign->user->id)); ?>"><?php echo e($assign->user->name); ?></a></div>
                    </div>

                </div>
            <?php endforeach; ?>
            </table>
            <?php echo e($assigns->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>