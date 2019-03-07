 
<?php $__env->startSection('content'); ?>
    <?php
    $cpp = Auth::user()->writerCategory->cpp;
    $decrease_percent = Auth::user()->writerCategory->deadline;
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Place Bid For Order: <strong>#<?php echo e($order->id); ?></strong> Topic: <strong><?php echo e($order->topic); ?></Strong> Page(s):<Strong><?php echo e($order->pages); ?></strong>
            </div>
        </div>
        <div class="panel-body">
            <?php if(count($mybid)>0): ?>
                <?php
                $amount = $mybid->amount;
                $message = $mybid->message
                ?>
                <div class="alert alert-info">You have already placed a bid for this order. You can update it here.</div>
                <?php else: ?>
                <?php
                if($bidmapper->bid_amount){
                    $amount = $bidmapper->bid_amount;
                } else{
                    $amount = $cpp*$order->pages;
                }
                    $message = "";

                ?>
                <?php endif; ?>
            <form class="form-horizontal" method="post" action="<?php echo e(URL::to('/writer/bid/'.$bidmapper->id)); ?>">
                <?php echo e(csrf_field()); ?>

                 <div class="form-group">
                      <label for="cpp" class="control-label col-md-3">CPP</label>
                       <div class="col-md-2">
                           <input onchange="convertCpp();" type="text" value="" name="cpp" class="form-control">
                       </div>

                       <label for="amount" class="control-label col-md-1">Total</label>
                       <div class="col-md-2">
                           <input type="text" value="<?php echo e($amount); ?>" onchange="convertTotal();" name="amount" class="form-control">
                       </div>                       
                   </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Message</label>
                    <div class="col-md-3">
                        <textarea class="form-control" name="message"><?php echo e($message); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>


    </div>

        <script type="text/javascript">
        convertTotal();
        function convertCpp(){
            var cpp = $("input[name='cpp']").val();
            var pages = '<?php echo e($order->pages); ?>';
            cpp = parseFloat(cpp);
            var pages = parseFloat(pages);
            var total = cpp*pages;
            total = total.toFixed(2);
            $("input[name='cpp']").val(cpp.toFixed(2));
            $("input[name='amount']").val(total);
        }

        function convertTotal(){
            var total = $("input[name='amount']").val();
            var pages = '<?php echo e($order->pages); ?>';
            pages = parseFloat(pages);
            total = parseFloat(total);
            var cpp = total/pages;
            cpp = cpp.toFixed(2);
            $("input[name='amount']").val(total.toFixed(2));
            $("input[name='cpp']").val(cpp);
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>