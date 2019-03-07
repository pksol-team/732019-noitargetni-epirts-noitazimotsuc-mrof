 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Return Order <strong>#<?php echo e($order->id." ".$order->topic); ?> </strong>to Revision
            </div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-5">Reason for Revision</label>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <textarea name="message" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-5">Deadline</label>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <input name="deadline" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-5">Revision Files</label>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <div id="files">
                       <input type="file" class="form-control" name="files[]">
                        </div>
                        <a onclick="return addFiles();" href="#"><i class="fa fa-plus fa-lg"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <input type="submit" class="btn btn-info" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function addFiles(){
            $("#files").append('<br/><input type="file" class="form-control" name="files[]">');
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>