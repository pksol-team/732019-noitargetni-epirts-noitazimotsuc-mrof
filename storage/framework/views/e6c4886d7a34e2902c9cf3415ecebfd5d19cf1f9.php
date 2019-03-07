 <?php
/**
 * The Template for displaying all single posts.
 *
 * @package Literacy
 */

//get_header(); ?>

<div class="content-area">
    <div class="middle-align content_sidebar">
        <div class="site-main" id="sitemain">
			<?php echo $__env->make('layouts.speedy.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
<!--         --><?php //get_sidebar('page'); ?>
        <div class="clear"></div>
    </div>
</div>

<?php //get_footer(); ?>