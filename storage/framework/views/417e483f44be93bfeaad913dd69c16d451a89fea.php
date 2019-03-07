 
<?php $__env->startSection('content'); ?>
    <?php
    $now = date('y-m-d H:i:s');
    if($order->bidmapper){
      $deadline = $order->bidmapper->deadline;
            $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($deadline));
            $remaining = $deadline->diffForHumans();  
    }
    
    $has_milestones = 0;
    $features = [];
    if($order->add_features){
        $features = \App\AdditionalFeature::whereIn('id',json_decode($order->add_features))->get();
    }
    foreach($features as $feature){
        $f_name = $feature->name;
        similar_text(strtolower($f_name),'progressive delivery',$percent);
        if($percent>80){
            $has_milestones = 1;
        }
    }
     $bidded = $order->bids()->where('user_id',Auth::user()->id)->first();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Order Topic: </strong><?php echo e($order->topic); ?>

            </div>
        </div>
        <div class="panel-body">
            <h2>Order Details</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a class="btn btn-info" data-toggle="tab" href="#o_order">Order</a></li>
                <?php /*<li><a class="btn btn-success" data-toggle="tab" href="#o_bids">Bids<span class="badge"><?php echo e(count($order->bids)); ?></span> </a></li>*/ ?>
                <li><a class="btn btn-primary" data-toggle="tab" href="#o_files">Files<span class="badge"><?php echo e(count($order->files)); ?></span></a></li>
                <?php if($has_milestones == 1): ?>
                    <li>
                        <a class="btn btn-success" data-toggle="tab" href="#progressive_milestones">Parts <span class="badge"><?php echo e($order->progressiveMilestones()->count()); ?></span> </a>
                    </li>
                <?php endif; ?>
            </ul>


            <div class="tab-content">
            <?php if($order->status == 0): ?>
             <?php if(!$bidded): ?>
                    <div class="alert alert-info">
                        You have not placed a bid on this order, kindly bid if you can work on it
                        <br/>
                        <a class="btn btn-success" href="<?php echo e(url("writer/bid/".$order->bidMapper->id)); ?>">Bid Now</a>

                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">
                        You have already placed a bid for this order, but you can still adjust it
                        <br/>
                        <a class="btn btn-success" href="<?php echo e(url("writer/bid/".$order->bidMapper->id)); ?>">View</a>

                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php echo $__env->make('writer.includes.order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('writer.includes.files', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php if($has_milestones == 1): ?>
                    <?php echo $__env->make('writer.includes.milestones', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>