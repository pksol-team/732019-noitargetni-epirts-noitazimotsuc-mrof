 <?php
/**
 * The Template for displaying all single posts.
 *
 * @package Literacy
 */

get_header(); ?>

<div class="content-area">
    <div class="middle-align content_sidebar">
        <div class="site-main" id="sitemain">
			@include('layouts.laravel_page')
        </div>
         <?php get_sidebar('page'); ?>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>