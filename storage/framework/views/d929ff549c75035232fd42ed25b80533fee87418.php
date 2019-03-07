<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            My Article Performance
        </div>
        <div class="panel-body">
         <?php echo $__env->make('client.redeem_notice', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <ul class="nav nav-tabs">
            <?php 
            $slug = 'stud';
            if(Auth::user()->role == 'writer')
                $slug = 'writer';


            ?>
                <li class="<?php echo e($tab=='approved' ? 'active':''); ?>">
                    <a href="<?php echo e(URL::to("$slug?tab=approved")); ?>">Approved <i class="badge"><?php echo e($approved_count); ?></i></a>
                    
                </li>
                 <li class="<?php echo e($tab=='drafts' ? 'active':''); ?>">
                    <a href="<?php echo e(URL::to("$slug?tab=drafts")); ?>">Drafts <i class="badge"><?php echo e($drafts_count); ?></i></a>
                    
                </li>
                <li class="<?php echo e($tab=='pending' ? 'active':''); ?>">
                    <a href="<?php echo e(URL::to("$slug?tab=pending")); ?>">Pending  <i class="badge"><?php echo e($pending_count); ?></i></a>
                   
                </li>
                <li class="<?php echo e($tab=='new' ? 'active':''); ?>">
                    <a href="<?php echo e(URL::to("$slug?tab=new")); ?>">New Article</a>
                </li>
                <?php if($tab == 'view'): ?>
                <li class="active">
                    <a href="<?php echo e(URL::to("$slug/article/$article->id")); ?>">View Article#<?php echo e($article->id); ?></a>
                </li>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
            <?php if($tab == 'edit' || $tab == 'new'): ?>
             <?php echo $__env->make('client.articles.tabs.'.$tab, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
             <?php elseif($tab == 'view'): ?>
             <?php echo $__env->make('client.articles.view', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('client.articles.tabs.approved', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>