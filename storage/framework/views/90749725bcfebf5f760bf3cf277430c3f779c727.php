<!-- <link href="<?php echo e(URL::to('css/bootstrap.min.css')); ?>" rel="stylesheet"> -->

<div style="margin:7px;" class="bootstrap-iso">
    <h3>Order Panel</h3>
    <?php echo $__env->make('layouts.speedy.menus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col-md-9">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
        <?php echo $__env->make('includes.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>






<script type="text/javascript">
    function getForPage(url){
        window.location = url;
    }
</script>
<style type="text/css">
    .bootstrap-iso .container {
        width: 1170px;
        width: 100% !important;
    }
</style>
<?php if(session('notice')): ?>
    <script type="text/javascript">
        $.toaster({ priority : "<?php echo e(session('notice')['class']); ?>", title : "<?php echo e(session('notice')['class']); ?>", message : "<?php echo e(session('notice')['message']); ?>"});
    </script>
    <?php session()->forget('notice'); ?>
<?php endif; ?>