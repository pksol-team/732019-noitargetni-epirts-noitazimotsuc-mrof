 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><?php echo e($website->name); ?> Email Templates <a onclick="return setEmail('','','');" href="#add_email_modal" class="pull-right btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i> Add Email</a> </div>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-bordered">
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach($emails as $email): ?>
                    <tr>
                        <td><?php echo e($email->id); ?></td>
                        <td><?php echo e($email->action); ?></td>
                        <td><?php echo $email->description ?></td>
                        <td>
                            <a onclick="" class="btn btn-success btn-xs" href="<?php echo e(URL::to("websites/emails/template/$email->id")); ?>"><i class="fa fa-edit"></i> Template</a>
                            <a onclick="return setEmail('<?php echo e($email->id); ?>','<?php echo e($email->action); ?>','<?php echo e($email->description); ?>');" class="btn btn-success btn-xs" href="#add_email_modal" data-toggle="modal"><i class="fa fa-edit"></i> </a>
                            <a href="<?php echo e(URL::to("websites/emails/delete/$email->id")); ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <?php echo e($emails->links()); ?>

        </div>
    </div>
<?php echo $__env->make('emails.add_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>