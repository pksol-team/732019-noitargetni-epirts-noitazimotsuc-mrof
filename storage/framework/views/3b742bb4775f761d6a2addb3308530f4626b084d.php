<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">

        <div class="panel-body">

        </div>
    </div>
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>