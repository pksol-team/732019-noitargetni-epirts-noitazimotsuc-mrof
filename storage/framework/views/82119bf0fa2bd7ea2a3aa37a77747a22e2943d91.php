<!-- <link href="<?php echo e(URL::to('css/bootstrap.min.css')); ?>" rel="stylesheet"> -->
<link href="<?php echo e(URL::to('css/ianbootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::to('css/font-awesome.min.css')); ?>" rel="stylesheet">
<script src="<?php echo e(URL::to('js/jquery.min.js')); ?>"></script>
  <link rel="stylesheet" href="<?php echo e(URL::to('css/star-rating.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::to('intl-tel-input-master/build/css/intlTelInput.css')); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo e(URL::to('intl-tel-input-master/build/js/intlTelInput.js')); ?>"></script>
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <script src="<?php echo e(URL::to('js/jquery.toaster.js')); ?>"></script>
  <script src="<?php echo e(URL::to('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('js/local.js')); ?>"></script>
  <link rel="stylesheet" href="<?php echo e(URL::to('css/chat.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
  <script src="<?php echo e(URL::to('js/star-rating.js')); ?>" type="text/javascript"></script>
  <script src="<?php echo e(URL::to('rating/jquery.MetaData.js')); ?>"></script>
  <link href="<?php echo e(URL::to('rating/jquery.rating.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(URL::to('rating/jquery.rating.js')); ?>"></script>
  <script src="<?php echo e(URL::to('js/star-rating.js')); ?>" type="text/javascript"></script>
    <link href="<?php echo e(URL::to('intl-tel-input-master/build/css/intlTelInput.css')); ?>" rel="stylesheet" type="text/css" />
  <script src="<?php echo e(URL::to('intl-tel-input-master/build/js/intlTelInput.js')); ?>"></script>
  <script src="<?php echo e(URL::to('chosen/chosen.jquery.js')); ?>"></script>
<script src="<?php echo e(URL::to('js/highcharts/js/highcharts.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(URL::to('js/highcharts/js/highcharts-more.js')); ?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo e(URL::to('chosen/chosen.css')); ?>">
<div style="margin:7px;" class="bootstrap-iso">
   <h3>Order Panel</h3>
<ul class="nav nav-tabs">
    <?php
    $no=0;
    $url = Request::url();
    $math_no = 0;
    ?>
    <?php foreach($menus as $menu): ?>
        <?php if($menu->type=='single' && @$menu->allow_writer != 'no'): ?>
            <?php
            $no++;
            if($url==URL::to($menu->menus->url)){
                $math_no = "tab_".$menu->slug;
            }
            ?>
            <li onclick="getForPage('<?php echo e(URL::to($menu->menus->url)); ?>');" class="<?php echo e($url==URL::to($menu->menus->url) ? "active":""); ?>"><a data-toggle="tab" href="<?php echo e(URL::to($menu->menus->url)); ?>"><?php echo e($menu->menus->label); ?>&nbsp;&nbsp;<span id="<?php echo e($menu->slug); ?>"></span></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if(Auth::user()): ?>
        <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(@$navbar_menu->account): ?>
        <?php foreach($navbar_menu->account as $rmenu): ?>
            <?php if(count($rmenu->children)>0 && Auth::user()): ?>
                <?php
                $label = str_replace("{name}",Auth::user()->name,$rmenu->label);
                if($rmenu->label=="{email}"){
                    $label =  str_replace("{email}",Auth::user()->email,$rmenu->label);
                }

                ?>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo e($label); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach($rmenu->children as $child): ?>
                            <?php
                            if($child->url=="{website}"){
                                $www_url = $www->home_url;
                                $ww_array = explode('/',$www_url);
                                unset($ww_array[count($ww_array)-1]);
                                $child->url=implode('/',$ww_array);
                            }
                            ?>
                            <li><a href="<?php echo e(URL::to($child->url)); ?>"><i class="fa <?php echo e($child->icon); ?>"></i> <?php echo e($child->label); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<div class="tab-content">
    <div id="<?php echo e($math_no); ?>" class="tab-pane fade in active">
<?php echo $__env->make('includes.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>

    </div>

</div>
</div>



<script type="text/javascript">
    function getForPage(url){
        window.location = url;
    }
</script>
<style type="text/css">
    .bootstrap-iso .container {
    width: 1170px;
    width: 100% !important;
}
</style>
<?php if(session('notice')): ?>
    <script type="text/javascript">
        $.toaster({ priority : "<?php echo e(session('notice')['class']); ?>", title : "<?php echo e(session('notice')['class']); ?>", message : "<?php echo e(session('notice')['message']); ?>"});
    </script>
    <?php session()->forget('notice'); ?>
<?php endif; ?>