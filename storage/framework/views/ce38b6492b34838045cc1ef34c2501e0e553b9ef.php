 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e(ucwords($role).' Announcements'); ?> <a class="btn btn-primary pull-right" href="<?php echo e(URL::to("announcements/add/$role")); ?>">Add Announcement</a></div>
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
                        <td><?php echo  str_replace('{name}','<strong>'.Auth::user()->name.'</strong>' ,nl2br($announcement->message)) ?></td>
                        <td><?php echo e(date('d/m/Y H:i', strtotime($announcement->created_at))); ?></td>
                        <td>
                            <?php if($announcement->published == 0): ?>
                            <button onclick="runPlainRequest('<?php echo e(URL::to('announcements/publish')); ?>',<?php echo e($announcement->id); ?>)" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Publish</button>
                            <button onclick="deleteItem('<?php echo e(URL::to('announcements/delete')); ?>',<?php echo e($announcement->id); ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</button>
                                <?php else: ?>
                                <button onclick="runPlainRequest('<?php echo e(URL::to('announcements/unpublish')); ?>',<?php echo e($announcement->id); ?>)" class="btn btn-xs btn-success"><i class="fa fa-thumbs-down"></i> UnPublish</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <?php echo e($announcements->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>