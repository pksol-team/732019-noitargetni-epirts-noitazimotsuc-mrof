 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Closed Orders</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Pages</th>
                    <th>Cost</th>
                    <th>Rating</th>
                    <th>Comments</th>
                    <th>On</th>
                    <th>Action</th>
                </tr>
                <?php foreach($assigns as $assign): ?>
                    <?php
                        $order = $assign->order;
                        $last_update = \Carbon\Carbon::createFromTimestamp(strtotime($assign->updated_at));
                        if($last_update->diffInDays()>=14 && $order->status != 6 && $assign->status == 4){
                            $assign->rating = 4;
                            $assign->comments = "AUTO APPROVED";
                            $order->status = 6;
                            $assign->save();
                            $order->update();
                        }
                        if($assign->user){
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td>$<?php echo e(number_format($order->amount,2)); ?></td>
                        <td>
                            <small>Writer: <strong>#<?php echo e($assign->user->id); ?></strong>-<?php echo e($assign->user->name); ?></small>
                            <?php if($assign->rating): ?>
                                <input style="font-size: small;" id="input-2" value="<?php echo e($assign->rating); ?>" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1">
                           <?php else: ?>

                                <i style="color: darkorange" class="fa fa-warning"></i> (Pending)
                                <?php if($order->user_id == Auth::user()->id): ?>
                  <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('stud/approve/'.''.$order->id)); ?>"><i class="fa fa-thumbs-up"></i> Approve</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo nl2br($assign->comments); ?></td>
                        <td><?php echo e(date('d M Y, h:i a',strtotime($assign->updated_at))); ?></td>
                        <th>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                        <a class="btn btn-info btn-xs" href="<?php echo e(URL::to("/order/$order->id/room/$assign->id")); ?>"><i class="fa fa-users fa-fw"></i>Room</a>
                                <?php if($order->user == Auth::user()): ?>

                                    <?php endif; ?>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Rating: </strong> <small>Writer: <strong>
                                        #<?php echo e($assign->user->id); ?></strong>-<?php echo e($assign->user->name); ?></small>
                                <?php if($assign->rating): ?>
                                <input style="font-size: small;" id="input-2" value="<?php echo e($assign->rating); ?>" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1">
                                <?php else: ?>
                                    <i style="color: darkorange" class="fa fa-warning"></i> (Pending)
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Placed: </strong><?php echo e(date('d M Y, h:i a',strtotime($order->created_at))); ?></div>
                        </div>
                    </div>
                        <?php 
                    }
                    ?>
                <?php endforeach; ?>
            </table>
            <?php echo e($assigns->links()); ?>

        </div>
    </div>
    </div>
    <script type="text/javascript">
        $('.rating').rating({displayOnly: true, step: 0.5});
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>