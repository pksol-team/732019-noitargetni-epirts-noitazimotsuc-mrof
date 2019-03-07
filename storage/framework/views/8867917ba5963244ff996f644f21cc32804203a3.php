<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
           Articles
        </div>
        <div class="panel-body">
        <?php if(isset($user)): ?>
        <div class="alert alert-info">Viewing articles for user: <a style="color:white;font-style: large;" href="<?php echo e(url("user/view/client/$user->id")); ?>"> <u><?php echo e($user->name.' ('.$user->email.')'); ?></u></a>

        </div>
        <a href="<?php echo e(url('order/articles?tab=published')); ?>">View All</a>
        <?php endif; ?>
            <ul class="nav nav-tabs">
                <li class="<?php echo e($tab=='published' ? 'active':''); ?>">
                    <a href="<?php echo e(URL::to("order/articles?tab=published&user=".@$user->id)); ?>">Published</a>
                </li>
                <li class="<?php echo e($tab=='pending' ? 'active':''); ?>">
                    <a href="<?php echo e(URL::to("order/articles?tab=pending&user=".@$user->id)); ?>">Pending</a>
                </li>
                <?php if($tab == 'view'): ?>
                    <li class="active">
                        <a href="<?php echo e(URL::to("order/articles/$article->id")); ?>">View Article#<?php echo e($article->id); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
                <?php if($tab == 'pending' || $tab == 'published'): ?>
                                <?php echo $__env->make('order.articles.tabs.pending', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                    <?php echo $__env->make('order.articles.tabs.'.$tab, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>