<!DOCTYPE html>
<html lang="en">
<head>
  <title>How It's Work</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon.ico" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
 
 <!-- header -->
 <?php include 'header.php' ?>
 <!-- header -->
 
 <!-- banner -->
 
   <div class="container-fluid slider full-width-form">
       <div class="row">
	      <div class="container">
		     <div class="row">
			     <div class="col-xs-12  left">
				   
				   <h1>How Its Work</h1>
				   <p>Your assignment, our responsibility. All you got to do is follow these easy 1-2-3-4 steps</p>
				    
				 </div>
			     <div class="col-xs-12 right">
			      <div class="row">
				   <!-- form -->
				     <?php include 'form.php'?>
				 <!--form -->
				 </div>
				
				 </div>
				 
				 <div class="col-xs-12 feature-head">
				       <div class="row">
					     <div class="col-xs-4 box">
						    <img src="assets/images/feature1.svg" class="icon" alt="img">
							<h5>24X7 Support</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="assets/images/feature2.svg" class="icon" alt="img">
							<h5>100+ Subjects</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="assets/images/feature3.svg" class="icon" alt="img">
							<h5>3000+ Phd Experts</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="assets/images/feature3.svg" class="icon" alt="img">
							<h5>3000+ Phd Experts</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="assets/images/feature3.svg" class="icon" alt="img">
							<h5>3000+ Phd Experts</h5>
						 </div>
					   </div>
				   </div>
			 </div>
			
		  </div>
	   </div>
   </div>
  

 <!-- banner -->
 
<!-- footer -->
<?php include 'footer.php'?>
<!-- footer -->
<!-- section  help service -->
<script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/custom.js"></script>
 <script>
var pos=$('.right').offset().top;
$(window).scroll(function(){
	
		if ($(window).width() > 991)
    {
	
	if($(this).scrollTop()>pos){
		
		
		$('.slider').addClass('sticky');
		$('.top-strip').addClass('sticky');
		$('.right').addClass('sticky');
		$('.form').addClass('container');
		$('.form').removeClass('col-xs-12');
		$('body').css('padding-top','40px')
	}
	else{
		$('.right').removeClass('sticky')
		$('.form').removeClass('container')
		$('.form').addClass('col-xs-12')
		$('.top-strip').removeClass('sticky')
		$('.slider').removeClass('sticky')
		$('body').css('padding-top','0px')
	}
	}
})
</script>  
</body>
</html>
