<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Designer Subject/Document Settings</div>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="<?php echo e($tab=='subjects' ? 'active':''); ?>"><a href="<?php echo e(URL::to("designer?tab=subjects")); ?>">Subjects</a></li>
                <li class="<?php echo e($tab=='documents' ? 'active':''); ?>"><a href="<?php echo e(URL::to("designer?tab=documents")); ?>">Documents</a></li>
            </ul>
            <div class="tab-content">
                <div class="row"></div>
                <?php echo $__env->make('settings.designer.tabs.'.$tab, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>