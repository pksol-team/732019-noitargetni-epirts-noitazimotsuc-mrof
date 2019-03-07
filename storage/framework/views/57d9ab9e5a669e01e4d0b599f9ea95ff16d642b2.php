 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Order Topic: </strong><?php echo e($order->topic); ?>

                <div class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks"> Action </i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo e(URL::to("order/edit/$order->id/")); ?>"><i class="fa fa-edit"></i> Edit</a>
                        </li>
                        <?php if($assign_id = @$order->assigns()->where('status',0)->get()[0]->id): ?>
                            <li><a href="<?php echo e(URL::to("order/$order->id/room/$assign_id")); ?>"><i class="fa fa-users"></i> Room</a>
                            </li>
                            <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
        <?php
        $features = [];
        if($order->add_features){
            $features = \App\AdditionalFeature::whereIn('id',json_decode($order->add_features))->get();
        }
        $has_milestones = 0;
        foreach($features as $feature){
            $f_name = $feature->name;
            similar_text(strtolower($f_name),'progressive delivery',$percent);
            if($percent>80){
                $has_milestones = 1;
            }
        }
        ?>
        <div class="panel-body">
            <h2>Order Details</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a class="btn btn-warning" data-toggle="tab" href="#o_order">Order</a></li>
                <li><a class="btn btn-info" data-toggle="tab" href="#o_bids">Bids<span class="badge"><?php echo e(count($order->bids)); ?></span> </a></li>
                <li><a class="btn btn-primary" data-toggle="tab" href="#o_files">Files<span class="badge"><?php echo e(count($order->files)); ?></span></a></li>
                <li><a class="btn btn-success" data-toggle="tab" onclick="markRead();" href="#o_messages">Messages<span class="badge"><?php echo e(count($order->messages()->where([
                ['seen','=',0],
                ['sender','=',0]
                ])->get())); ?></span></a></li>
                <?php /*<li><a data-toggle="tab" href="#o_client"><i class="fa fa-user"></i> Client</a></li>*/ ?>
                <?php if($has_milestones == 1): ?>
                    <li>
                        <a class="btn btn-info" data-toggle="tab" href="#progressive_milestones">Milestones <span class="badge"><?php echo e($order->progressiveMilestones()->count()); ?></span> </a>
                    </li>
                <?php endif; ?>
            </ul>


                <div class="tab-content">
                    <?php echo $__env->make('order.includes.order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('order.includes.bids', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('order.includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('order.includes.files', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('order.includes.client', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php if($has_milestones == 1): ?>
                        <?php echo $__env->make('order.includes.milestones', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>