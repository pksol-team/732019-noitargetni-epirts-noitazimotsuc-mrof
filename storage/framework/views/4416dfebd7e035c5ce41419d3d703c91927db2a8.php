<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e('Announcements'); ?></div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

                <?php foreach($announcements as $announcement): ?>
                    <tr>
                        <td><?php echo e($announcement->id); ?></td>
                        <td><?php echo  str_replace('{name}','<strong>'.Auth::user()->name.'</strong>' ,nl2br(str_limit($announcement->message))) ?></td>
                        <td><?php echo e(date('d/m/Y H:i', strtotime($announcement->created_at))); ?></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="<?php echo e(URL::to("announcements/read/$announcement->id")); ?>">More... </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo e($announcements->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>