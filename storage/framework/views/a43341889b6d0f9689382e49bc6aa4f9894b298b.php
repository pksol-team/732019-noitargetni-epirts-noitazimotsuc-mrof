 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Confirm Completed Order <strong>#<?php echo e($order->id); ?> - <?php echo e($order->topic); ?></strong></div>
        </div>
        <div class="panel-body">
            <div style="font-size: large;" class="alert alert-success"><strong><i class="fa fa-info fa-2x"></i> Confirm Completed Order</strong><br/>
                <p>
                    Confirming the order will release all the writer files to be visible to the client.
                    Please make sure that there is no any plagiarism or personalized messages in the submitted papers
               </p>
                <?php /*<strong>Please Rate the Writer According to Performance</strong>*/ ?>
                <div class="row"></div>
            <form class="form-horizontal" method="post" action="<?php echo e(URL::to("order/$order->id/confirm/$assign->id")); ?>">
                <?php echo e(csrf_field()); ?>

                <input name="_method" value="put" type="hidden">
               <!-- <div class="form-group">
                    <label class="control-label col-md-3">Comments</label>
                    <div class="col-md-5">
                        <textarea name="comments" class="form-control"><?php echo e($assign->comments); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-2" class="control-label col-md-3">Rate Writer</label>
                    <div class="col-md-5">
                        <input id="input-2" value="<?php echo $assign->rating;?>" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1">
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label col-md-3 pull-le">&nbsp;</label>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $('#inrrput-2').rating({displayOnly: true, step: 0.5});
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>