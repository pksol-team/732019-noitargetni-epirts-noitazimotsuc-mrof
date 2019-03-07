<?php $__env->startSection('content'); ?>
<ul class="nav nav-tabs">
    <li class="<?php echo e($tab=='active' ? 'active':''); ?> " id="client_active"><a href="<?php echo e(url("stud")); ?>">Active</a></li>
    <li class="<?php echo e($tab=='unpaid' ? 'active':''); ?>" id="client_un_payment"><a href="<?php echo e(url("stud/unpaid")); ?>">Pending</a></li>
    <li class="<?php echo e($tab=='disputes' ? 'active':''); ?>" id="client_completed"><a href="<?php echo e(url("stud/disputes")); ?>">Resolution Center</a></li>
    <li class="<?php echo e($tab=='completed' ? 'active':''); ?>" id="client_disputes"><a href="<?php echo e(url("stud/completed")); ?>">Finished</a></li>
</ul>

<div class="tab-content">
    <br/>
    <?php echo $__env->make('client.tabs.'.$tab, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>