<?php $__env->startSection('header'); ?>
<?php echo $__env->make('front.sub_parts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('content'); ?>

<?$title= "Cheap Essay Help | High Quality at Affordable Price" ?>
<?$description= "Get help on cheap custom essays written based on your requirements. We offer affordable essay help and protect your privacy." ?>
<?php $__env->startSection('title',$details[0]->title); ?>
<?php $__env->startSection('description',$details[0]->description); ?>
 <!-- how its work -->
<div class="container-fluid gaurantees">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1><?php echo e($details[0]->main_heading); ?></h1>
				</div>
			</div>
		    <div class="row">
			   <div class="col-xs-12 contents masterclass">
			   
			           <?php echo $__env->make('front.sub_parts.leftsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				 
				    <div class="col-sm-4 col-md-3 col-xs-12 sidebar-right">
					  <div class="col-xs-12 box-main">
				        <?php echo $details[0]->main_content; ?>

					  </div>
					  <?php if($details[0]->order_custom_section=='1'): ?>
					  <?php echo $__env->make('front.sub_parts.ordercustom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				      <?php endif; ?>
					  <div class="col-xs-12 box-main">
				        <?php echo $details[0]->second_content; ?>

					  </div>
                         <?php if($details[0]->confidentiality_authenticity_section=='1'): ?>
				        <?php echo $__env->make('front.sub_parts.confidentialityauthenticity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				        <?php endif; ?>
					</div>
			   </div>
			</div>
		</div>
	</div>
</div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('front.sub_parts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldSection(); ?>	
<?php echo $__env->make('front.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>