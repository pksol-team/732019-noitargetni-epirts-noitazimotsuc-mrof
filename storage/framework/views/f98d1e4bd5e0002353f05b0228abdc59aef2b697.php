<link href="<?php echo e(url("basic_files/styles.css")); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo e(url("basic_files/bootstrap-iso.css")); ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo e(url("js/jquery.min.js")); ?>"></script>
<link href="<?php echo e(url("basic_files/styles(1).css")); ?>" rel="stylesheet" type="text/css"
      media="screen">
<script src="<?php echo e(URL::to('js/jquery.datetimepicker.js')); ?>"></script>
<link href="<?php echo e(URL::to('rating/jquery.rating.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::to('css/range.css')); ?>" rel="stylesheet">
<script src="<?php echo e(URL::to('rating/jquery.rating.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(URL::to('css/star-rating.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo e(URL::to('css/chat.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo e(URL::to('js/star-rating.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(URL::to('js/highcharts/js/highcharts.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(URL::to('js/highcharts/js/highcharts-more.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(URL::to('js/jquery.toaster.js')); ?>"></script>
<script src="<?php echo e(URL::to('js/bootstrap.min.js')); ?>"></script>
<div id="main-content">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td valign="top">
                <?php if(Auth::user()): ?>
                <div id="myaccount_links" style="display: block;">

                    <div id="getfacts">

                        <!--<p><a href="../message/"><strong>Simple, direct message &raquo;&raquo;</strong></a></p>-->
                        <p style="padding-left:10px;"><strong>Welcome,<br/><a href="<?php echo e(url("user/profile")); ?>"><?php echo e(Auth::user()->name); ?></a></strong></p>
                        <?php foreach($menus as $menu): ?>
                            <?php if($menu->type=='single' && @$menu->allow_writer != 'no'): ?>
                                <?php if($www->designer == 1): ?>
                                    <?php
                                    $real_label = strtolower($menu->menus->label);
                                    $real_label = str_replace('orders','projects',$real_label);
                                    $design_label = ucwords($real_label);
                                    ?>
                                    <li>
                                        <a href="<?php echo e(URL::to($menu->menus->url)); ?>"><i class="fa <?php echo e($menu->menus->icon); ?>"></i> <?php echo e($design_label); ?>&nbsp;&nbsp;&nbsp;<span class="" id="<?php echo e(@$menu->slug); ?>"></span></a>
                                    </li>
                                <?php else: ?>
                                    <a href="<?php echo e(URL::to($menu->menus->url)); ?>"><span class="<?php echo e(@$menu->class); ?>"> <?php echo e($menu->menus->label); ?><span class="" id="<?php echo e(@$menu->slug); ?>"></span></span>
                                    </a>
                                    <div class="seps_l"></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <hr>
                        <a href="<?php echo e(url("user/profile")); ?>"><span class="icon_account">My Profile </span></a>
                        <div class="seps_l"></div>
                        <div class="seps_l"></div>
                        <a href="<?php echo e(url("logout")); ?>"><span class="icon_exit">Logout </span></a>
                        <div class="seps_l"></div>

                    </div>
                </div>
                <?php endif; ?>
            </td>
            <td width="89%" valign="top" style="padding:0 5px;">
                <div class="bootstrap-iso" style="padding: 15px;">
                    <div class="container">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<?php echo $__env->make('includes.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>