 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
               Template Chooser
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-5">
                <form action="" method="post" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="PUT">
                    <select class="form-control" name="template_id">
                        <option value="">New Template</option>
                        <?php foreach($templates as $template): ?>
                            <option value="<?php echo e($template->id); ?>"><?php echo e($template->action); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>Proceed</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>