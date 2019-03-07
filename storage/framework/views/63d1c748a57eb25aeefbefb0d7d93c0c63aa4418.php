 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">New Academic Level</div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="<?php echo e(URL::to('settings/academic/add')); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($academic->id); ?>">
                <div class="form-group">
                    <label class="control-label col-md-3">Level Name</label>
                    <div class="col-md-4">
                        <input type="text" value="<?php echo e($academic->level); ?>" required name="level" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-4">
                        <textarea required name="description" class="form-control"><?php echo e($academic->description); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>