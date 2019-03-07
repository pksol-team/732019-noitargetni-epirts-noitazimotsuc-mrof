            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Category</th>
                    <th>Cost</th>
                    <?php if($website->designer == 1): ?>
                        <th>Designer ID</th>
                    <?php else: ?>
                        <th>Writer ID</th>
                        <th>Pages</th>
                    <?php endif; ?>
                    <th>Action</th>
                </tr>

                <?php foreach($orders as $order): ?>
                    <?php
                    $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->topic); ?></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><?php echo e($order->document->label); ?></td>
                        <td><?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?></td>

                        <td>
                            <?php if($assign = $order->assigns()->where('status','<=','4')->first()): ?>
                                <?php echo e($assign->user_id); ?>

                            <?php else: ?>
                                --
                            <?php endif; ?>
                        </td>
                        <?php if($website->designer == 1): ?>

                        <?php else: ?>
                            <td><?php echo e($order->pages); ?></td>
                        <?php endif; ?><td>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('stud/order/'.''.$order->id.'#o_files')); ?>"><i class="fa fa-file"></i> Files</a>

                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                            <?php if($order->status==4): ?>
                                <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('stud/approve/'.''.$order->id)); ?>"><i class="fa fa-thumbs-up"></i> Approve</a>
                            <?php elseif($order->status == 4): ?>
                                <a class="btn btn-danger btn-xs" href="<?php echo e(URL::to('stud/dispute/'.''.$order->id)); ?>"><i class="fa fa-thumbs-down"></i> Revise</a>
                            <?php endif; ?>
                            <?php if($order->amount > $order->getTotalPaid()): ?>
                                <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay Pending(<?php echo e(@number_format($order->amount-$order->payments()->sum('amount'),2)); ?>)</a>
                            <?php endif; ?>

                            <?php
                            $completed = \Carbon\Carbon::createFromTimestamp(strtotime($order->updated_at));
                            if($order->status == 6 && $completed->diffInDays() < 14){
                            ?>
                            <a class="btn btn-danger btn-xs" href="<?php echo e(URL::to('stud/dispute/'.''.$order->id)); ?>"><i class="fa fa-thumbs-down"></i> Revise</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><?php echo e($order->id); ?> - <?php echo e($order->topic); ?></a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('stud/order/'.''.$order->id)); ?>"><i class="fa fa-eye"></i> View</a>
                                <?php if($order->status==4 && $order->amount <= $order->payments()->sum('amount')): ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay Pending(<?php echo e(@number_format($order->amount-$order->payments()->sum('amount'),2)); ?>)</a>
                                    <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('stud/approve/'.''.$order->id)); ?>"><i class="fa fa-thumbs-up"></i> Approve</a>
                                <?php elseif($order->status == 4): ?>
                                    <a class="btn btn-danger btn-xs" href="<?php echo e(URL::to('stud/dispute/'.''.$order->id)); ?>"><i class="fa fa-thumbs-down"></i> Revise</a>
                                <?php endif; ?>
                                <?php if($order->amount > $order->payments()->sum('amount')): ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay Pending(<?php echo e(@number_format($order->amount-$order->payments()->sum('amount'),2)); ?>)</a>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-4"><strong>Subject: </strong><?php echo e($order->subject->label); ?></div>
                                <div class="col-sm-3"><strong>Pages: </strong><?php echo e($order->pages); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4"><strong>Placed: </strong><?php echo e(date('d M Y, h:i a',strtotime($order->created_at))); ?></div>
                                <div class="col-sm-2"><strong>Cost: </strong><?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?></div>
                            </div>

                        </div>
                <?php endforeach; ?>
            </table>
            <?php echo e($orders->links()); ?>

