<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e('View Announcement'); ?></div>
        <div class="panel-body">

            <table align="centre" class="table table-bordered">
                <tr>
                    <td class="titlecolumn">ID</td>
                    <td><?php echo e($announcement->id); ?></td>
                    <td class="titlecolumn">Date</td>
                    <td><?php echo e(date('d/m/Y H:i', strtotime($announcement->created_at))); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Announcement Body</strong></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <?php echo  str_replace('{name}','<strong>'.Auth::user()->name.'</strong>' ,nl2br($announcement->message)) ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <style type="text/css">
        .titlecolumn {
            background: whitesmoke;
            white-space: nowrap;
            text-align: right;
            font-weight: bold;
            width: 5%;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>