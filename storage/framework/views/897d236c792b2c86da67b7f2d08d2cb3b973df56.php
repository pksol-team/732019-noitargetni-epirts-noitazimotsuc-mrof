<?php $__env->startSection('content'); ?>
    <?php
    $cpp = Auth::user()->writerCategory->cpp;
    $decrease_percent = Auth::user()->writerCategory->deadline;

    if($order->bidmapper->deadline == '0000-00-00 00:00:00'){
    $c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
    $decrease_percent = 100-$decrease_percent;
    $decrease_percent = $decrease_percent/100;
    $new_hours = $c_deadline->diffInHours()*$decrease_percent;
    $b_deadline = \Carbon\Carbon::now()->addHours($new_hours);
    }else{
    $b_deadline = $bidmapper->deadline;
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Take Order: <strong>#<?php echo e($order->id); ?></strong> Topic: <strong><?php echo e($order->topic); ?></Strong> Page(s):<Strong><?php echo e($order->pages); ?></strong>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-bordered">
                <tr>
                    <th>Order</th>
                    <td>#<?php echo e($order->id); ?>#<?php echo e($order->topic); ?></td>
                </tr>
                <tr>
                    <th>Pages</th>
                    <td><?php echo e($order->pages); ?></td>
                </tr>
                <tr>
                    <th>Deadline</th>
                    <td><?php echo e(date('d M Y, h:i a',strtotime($b_deadline))); ?></td>
                </tr>
            </table>

                <?php
                $amount = $bidmapper->take_amount;
                if($amount == 0){
                   $amount = $cpp*$order->pages;
                }

                ?>

            <form class="form-horizontal" method="post" action="<?php echo e(URL::to('/writer/take/'.$bidmapper->id)); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="deadline" value="<?php echo e($b_deadline); ?>">
                <input type="hidden" value="<?php echo e($amount); ?>" onchange="convertTotal();" name="amount" class="form-control">

                <div class="form-group">
                    <label for="cpp" class="control-label col-md-3">CPP</label>
                    <div class="col-md-2">
                        <input disabled onchange="convertCpp();" type="text" value="" name="cpp" class="form-control">
                    </div>
                    <label for="amount" class="control-label col-md-1">Total</label>
                    <div class="col-md-2">
                        <input disabled type="text" value="<?php echo e($amount); ?>" onchange="convertTotal();" name="amount" class="form-control">
                    </div>

                </div>
               <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Take Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        convertTotal();
        convertCpp();
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