 
<?php $__env->startSection('content'); ?>
<?php

        $writerCategory = Auth::user()->writerCategory;
//        if(!$writerCategory){
//            $writer = Auth::user();
//            $writerCategory = \App\WriterCategory::first();
//            $writer->writer_category_id = $writerCategory->id;
//            $writer->save();
//        }
        $cpp = $writerCategory->cpp;
        $decrease_percent = $writerCategory->deadline;
        $category_id = $writerCategory->id;
        ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Available</div>
        </div>
        <div class="panel-body">
            <?php if(Auth::user()->status==0): ?>
                <div class="panel-body">
                    <div style="font-size: large;" class="alert alert-danger">
                        Hello <?php echo e(Auth::user()->name); ?>,<br/>
                        Your account has not yet been activated.
                    </div>
                </div>
                <?php elseif(Auth::user()->suspended==1): ?>
                <div style="font-size: large;" class="alert alert-danger">
                    Hello <?php echo e(Auth::user()->name); ?>,<br/>
                    Your account has been suspended
                </div>
                <?php else: ?>
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Pages</th>
                    <th>Amount</th>
                    <th>Bids</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                <?php foreach($bidmappers as $bidmapper): ?>
                    <?php
                    $order = $bidmapper->order;
                    $b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($bidmapper->deadline));

                    $c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));

                    if($bidmapper->deadline == '0000-00-00 00:00:00'){
                        $decrease_percent = 100-$decrease_percent;
                        $decrease_percent = $decrease_percent/100;
                        $new_hours = $c_deadline->diffInHours()*$decrease_percent;
                        $b_deadline = \Carbon\Carbon::now()->addHours($new_hours);
                    }
                    if($order->designer == 1){
                        $b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
                    }

                        $remaining = $b_deadline->diffForHumans();
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e($order->pages != 0 ? $order->pages:'-'); ?></td>
                        <td>
                            <?php if($order->designer == 1): ?>
                                -
                                <?php else: ?>
                            <?php if($bidmapper->bid_amount): ?>
                                <?php echo e(number_format($bidmapper->bid_amount,2)); ?>

                                <?php else: ?>
                                <?php echo e(number_format($cpp*$order->pages,2)); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            </td>
                        <td><?php echo e(count($order->bids()->get())); ?></td>
                        <td><?php echo $remaining; ?></td>
                        <th>
                            <?php if(json_decode($bidmapper->allow_take) && in_array($category_id,json_decode($bidmapper->allow_take))): ?>
                            <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/writer/take/'.''.$bidmapper->id)); ?>"><i class="fa fa-thumbs-up"></i> Take</a>
                            <?php endif; ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/writer/bid/'.''.$bidmapper->id)); ?>"><i class="fa fa-thumbs-up"></i> Bid</a>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/writer/order/'.''.$order->id)); ?>"><i class="fa fa-eye fa-fw"></i> View</a>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/writer/bid/'.''.$bidmapper->id)); ?>"><i class="fa fa-thumbs-up"></i> Bid</a>
                                <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/writer/order/'.''.$order->id)); ?>"><i class="fa fa-eye fa-fw"></i> View</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                            <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                            <div class="col-sm-3"><strong>Total: </strong><?php echo e(number_format($bidmapper->bid_amount,2)); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"><strong>Deadline: </strong><?php echo $remaining; ?></div>
                            <div class="col-sm-2"><strong>Bids: </strong><?php echo e(count($order->bids()->get())); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php echo e($bidmappers->links()); ?>

            </table>
                <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>