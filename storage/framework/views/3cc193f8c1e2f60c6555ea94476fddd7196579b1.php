<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Order Panel - <?php echo e($_SERVER['HTTP_HOST']); ?></title>


  <link href="<?php echo e(URL::to('css/bootstrap.min.css')); ?>" rel="stylesheet">

  <link href="<?php echo e(URL::to('css/font-awesome.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(URL::to('css/animate.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(URL::to('css/custom.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(URL::to('tinymce/tinymce.min.js')); ?>"></script>

  <script src="<?php echo e(URL::to('js/local.js')); ?>"></script>

  <!-- Custom styling plus plugins -->
  <link href="<?php echo e(URL::to('magicsuggest/magicsuggest.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('css/maps/jquery-jvectormap-2.0.3.css')); ?>" />
  <link href="<?php echo e(URL::to('css/icheck/flat/green.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(URL::to('css/floatexamples.css')); ?>" rel="stylesheet" type="text/css" />

  <script src="<?php echo e(URL::to('js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('js/nprogress.js')); ?>"></script>


  <script src="<?php echo e(URL::to('magicsuggest/magicsuggest.js')); ?>"></script>
  <script src="<?php echo e(URL::to('rating/jquery.MetaData.js')); ?>"></script>
  <link href="<?php echo e(URL::to('rating/jquery.rating.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(URL::to('css/range.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(URL::to('rating/jquery.rating.js')); ?>"></script>
  <link rel="stylesheet" href="<?php echo e(URL::to('css/star-rating.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="<?php echo e(URL::to('css/chat.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="<?php echo e(URL::to('css/throbber.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
  <?php /*<script src="<?php echo e(URL::to('js/local.js')); ?>"></script>*/ ?>
  <link href="<?php echo e(URL::to('css/jquery.datetimepicker.css')); ?>" rel="stylesheet" type="text/css">

  <link href="<?php echo e(URL::to('intl-tel-input-master/build/css/intlTelInput.css')); ?>" rel="stylesheet" type="text/css" />
  <script src="<?php echo e(URL::to('intl-tel-input-master/build/js/intlTelInput.js')); ?>"></script>

  <script src="<?php echo e(URL::to('js/star-rating.js')); ?>" type="text/javascript"></script>
  <script src="<?php echo e(URL::to('js/highcharts/js/highcharts.js')); ?>" type="text/javascript"></script>
  <script src="<?php echo e(URL::to('js/highcharts/js/highcharts-more.js')); ?>" type="text/javascript"></script>
  <script src="<?php echo e(URL::to('js/jquery.toaster.js')); ?>"></script>
  <script src="<?php echo e(URL::to('js/bootstrap.min.js')); ?>"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<link rel="stylesheet" href="<?php echo e(URL::to('chosen/chosen.css')); ?>">
<script src="<?php echo e(URL::to('chosen/chosen.jquery.js')); ?>" type="text/javascript"></script>
<?php
$t_color = "#5baaef";
?>
<?php if(isset($t_color)): ?>
<style type="text/css">
.nav_title {
    background: <?php echo $t_color ?> !important;
}
.main_container {
    background: <?php echo $t_color ?> !important;
}

element.style {
}
body.nav-md .container.body .col-md-3.left_col {
    background-color: <?php echo $t_color ?> !important;
}
.nav_menu {
    background: <?php echo $t_color ?> !important;
}
</style>
<?php endif; ?>
</head>


<body class="nav-md">

  <div class="container body" style="width: 100% !important;padding: 0px !important;">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo e(URL::to($navbar_menu->url)); ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo e($navbar_menu->label); ?></span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img height="" src="<?php if(@Auth::user()->image): ?> <?php echo e(URL::to(Auth::user()->image)); ?> <?php else: ?> <?php echo e(URL::to('images/img.png')); ?> <?php endif; ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info row">
              <span>Welcome,</span>
              <?php if(Auth::user()): ?>
                <h2><?php echo e(Auth::user()->name); ?></h2>
                <?php else: ?>
                <h2>Guest</h2>
              <?php endif; ?>

            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
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
                      <li>
                        <a href="<?php echo e(URL::to($menu->menus->url)); ?>"><i class="fa <?php echo e($menu->menus->icon); ?>"></i> <?php echo e($menu->menus->label); ?>&nbsp;&nbsp;&nbsp;<span class="" id="<?php echo e(@$menu->slug); ?>"></span></a>
                      </li>
                      <?php endif; ?>
                  <?php endif; ?>

                  <?php if($menu->type=='many'): ?>
                      <li><a><i class="fa <?php echo e($menu->icon); ?>"></i> <?php echo e($menu->label); ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                          <?php foreach($menu->menus as $drop): ?>
                            <?php if($drop->label): ?>
                            <li><a href="<?php echo e(URL::to($drop->url)); ?>"><?php echo e($drop->label); ?></a><li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </ul>
                      </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <?php /*<div class="sidebar-footer hidden-small">*/ ?>
            <?php /*<a data-toggle="tooltip" data-placement="top" title="Settings">*/ ?>
              <?php /*<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>*/ ?>
            <?php /*</a>*/ ?>
            <?php /*<a data-toggle="tooltip" data-placement="top" title="FullScreen">*/ ?>
              <?php /*<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>*/ ?>
            <?php /*</a>*/ ?>
            <?php /*<a data-toggle="tooltip" data-placement="top" title="Lock">*/ ?>
              <?php /*<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>*/ ?>
            <?php /*</a>*/ ?>
             <?php /*<a href="<?php echo e(URL::to('logout')); ?>" data-placement="top" title="Logout">*/ ?>
              <?php /*<span class="glyphicon glyphicon-off" aria-hidden="true"></span>*/ ?>
            <?php /*</a>*/ ?>
          <?php /*</div>*/ ?>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <div class="nav toggle">
              <a href="<?php echo e(URL::to('http://'.$_SERVER['HTTP_HOST'])); ?>" id=""><i class="fa fa-home"></i>Home</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <?php if($navbar_menu->account): ?>
                <?php foreach($navbar_menu->account as $rmenu): ?>
                  <?php if(count($rmenu->children)>0 && Auth::user()): ?>
                    <?php
                    $label = str_replace("{name}",Auth::user()->name,$rmenu->label);
                    if($rmenu->label=="{email}"){
                      $label =  str_replace("{email}",Auth::user()->email,$rmenu->label);
                    }

                    ?>

                    <li class="">
                      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php if(Auth::user()->image): ?> <?php echo e(URL::to(Auth::user()->image)); ?> <?php else: ?> <?php echo e(URL::to('images/img.png')); ?> <?php endif; ?>" alt=""><?php echo e($label); ?>

                        <span class=" fa fa-angle-down"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
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
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </li>
                  <?php else: ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
              <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->



      <div id="right_col" class="right_col" role="main">
        <br/>
        <br/>
        <?php if(@Auth::user()->role=='admin'): ?>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-md-4">
              <input name="search" value="<?php echo e(Request::get('search')); ?>" placeholder="Search current records" type="text" class="form-control">
            </div>
          </div>
        </form>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

<style type="text/css">
  .gridular{
    display: none;
  }
</style>


  <script src="<?php echo e(URL::to('js/progressbar/bootstrap-progressbar.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('js/nicescroll/jquery.nicescroll.min.js')); ?>"></script>
  <!-- icheck -->
  <script src="<?php echo e(URL::to('js/icheck/icheck.min.js')); ?>"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="<?php echo e(URL::to('js/moment/moment.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(URL::to('js/datepicker/daterangepicker.js')); ?>"></script>
  <!-- chart js -->
  <script src="<?php echo e(URL::to('js/chartjs/chart.min.js')); ?>"></script>

  <script src="<?php echo e(URL::to('js/custom.js')); ?>"></script>




  <script src="<?php echo e(URL::to('js/pace/pace.min.js')); ?>"></script>

  <!-- skycons -->
  <script src="<?php echo e(URL::to('js/skycons/skycons.min.js')); ?>"></script>


  <!-- dashbord linegraph -->
  <script>



  </script>
  <script>
    NProgress.done();
  </script>
  <!-- /datepicker -->
  <!-- /footer content -->
</body>
<script src="<?php echo e(URL::to('js/jquery.datetimepicker.js')); ?>"></script>
<script type="text/javascript">
  $('a[href="' + window.location.hash + '"]').trigger('click');
  $('input[name="deadline"]').datetimepicker();
</script>
<?php echo $__env->make('includes.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(@Auth::user()->role != 'admin'): ?>
<script type="text/javascript">
//var Tawk_API=Tawk_API||{};
//
//          Tawk_API.visitor = {
//              name  : "Jasper Michieka",
//              email : "jazmokua@gmail.com"
//          };
//        var Tawk_LoadStart=new Date();
//(function(){
//var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
//s1.async=true;
//s1.src='https://embed.tawk.to/597605370d1bb37f1f7a59ca/default';
//s1.charset='UTF-8';
//s1.setAttribute('crossorigin','*');
//s0.parentNode.insertBefore(s1,s0);
//})();
</script>
<?php endif; ?>
</html>
<?php if(session('notice')): ?>
  <script type="text/javascript">
    $.toaster({ priority : "<?php echo e(session('notice')['class']); ?>", title : "<?php echo e(session('notice')['class']); ?>", message : "<?php echo e(session('notice')['message']); ?>"});
  </script>
  <?php session()->forget('notice'); ?>
<?php endif; ?>
