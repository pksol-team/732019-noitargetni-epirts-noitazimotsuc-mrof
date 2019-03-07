<html lang="en">
<head>
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
  <!-- START - Open Graph for Facebook, Google+ and Twitter Card Tags 2.2.4.2 -->
 <!-- Facebook Open Graph -->
 <!-- Google+ / Schema.org -->
  
  <!--<meta itemprop="publisher" content="assignmently.com"/>--> <!-- To solve: The attribute publisher.itemtype has an invalid value -->
 <!-- Twitter Cards -->
  <meta name="twitter:title" content="Order Now!!"/>
  <meta name="twitter:url" content="https://www.assignmently.com/stud/new"/>
  <meta name="twitter:description" content="&quot;Can you write my academic papers?&quot; - Of course, yes! I have done it many times! ✅100% Plagiarism Free and Full Confidentiality. Choose the best writer and get high-quality essay on-time."/>
  <meta name="twitter:image" content="<?php echo e(URL::asset('front/images/assignment%20help%20profile%20picture.jpg')); ?>"/>
  <meta name="twitter:card" content="summary"/>
  <meta name="twitter:site" content="@takemycourses"/>
 <!-- SEO -->
 <!-- Misc. tags -->
 <!-- is_singular | yoast_seo -->
<!-- END - Open Graph for Facebook, Google+ and Twitter Card Tags 2.2.4.2 -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo e(URL::asset('front/images/favicon.ico')); ?>" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="<?php echo e(URL::asset('front/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(URL::asset('front/css/style.css')); ?>">
  <link rel="stylesheet" href="https://www.assignmently.com/chosen/chosen.css">  
  <script src="https://www.assignmently.com/js/jquery.min.js"></script>
  <script src="<?php echo e(URL::asset('front/js/custom.js')); ?>"></script>

  <script src="https://www.assignmently.com/chosen/chosen.jquery.js" type="text/javascript"></script>	
  <!--Start of Zopim Live Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="//v2.zopim.com/?1gkgm32NX10DR4NgYJcrg8zyZODa5OW9";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
		</script>
		<!--End of Zopim Live Chat Script-->
		
	<script type="text/css">

	  $zopim(function() {
	    $zopim.livechat.addTags("Assignmently.com");
	  });
	 
	</script>
</head>

<body>
			<?php $__env->startSection('header'); ?>
			<?php echo $__env->yieldContent('header'); ?>
			<?php echo $__env->yieldSection(); ?>
			<?php echo $__env->yieldContent('content'); ?>
			<?php $__env->startSection('footer'); ?>
			<?php echo $__env->yieldContent('footer'); ?>
			<?php echo $__env->yieldSection(); ?>
</body>
</html>