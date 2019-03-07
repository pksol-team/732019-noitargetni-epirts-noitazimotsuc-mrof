 
<?php $__env->startSection('content'); ?>
    <?php
    $decrease_percent = $bid->user->writerCategory->deadline;
    if($order->bidmapper->deadline == '0000-00-00 00:00:00'){
        $c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
        $decrease_percent = 100-$decrease_percent;
        $decrease_percent = $decrease_percent/100;
        $new_hours = $c_deadline->diffInHours()*$decrease_percent;
        $b_deadline = \Carbon\Carbon::now()->addHours($new_hours);
    }else{
        $b_deadline = $order->bidmapper->deadline;
    }
            ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                View Bid:<strong>#<?php echo e($bid->id); ?></strong> On Order:<strong>#<?php echo e($order->id.'-'.$order->topic); ?></strong> Order Amount: <strong><?php echo e(number_format($order->amount,2)); ?></strong> Deadline <strong><?php echo e(date('d M Y, h:i a',strtotime($order->deadline))); ?></strong>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-5">
                <table class="table table-condensed table-bordered">
                    <tr>
                        <th>Writer</th>
                        <td><?php echo e($bid->user->name); ?></td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td><?php echo e($bid->amount); ?></td>
                    </tr>
                    <tr>
                        <th colspan="2">Message</th>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo e($bid->message); ?></td>
                    </tr>
                    <tr>
                        <th>On</th>
                        <td><?php echo e(date('d M Y, h:i a',strtotime($bid->created_at))); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Assign to Writer</div>
                    <div class="panel-body">
                        <?php if($order->status==0): ?>
                        <form class="form-horizontal" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="control-label col-md-2">Amount</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="amount" value="<?php echo e($bid->amount); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Bonus</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="bonus" value="0.00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Deadline</label>
                                <div class="col-md-8">
                                    <input type="text" name="deadline" value="<?php echo e($b_deadline); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">&nbsp;</label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Assign</button>
                                </div>
                            </div>
                        </form>
                            <?php else: ?>
                        <div class="alert alert-info">
                            This order has been assigned to another writer
                        </div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>