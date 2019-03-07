<?php $__env->startSection('header'); ?>
<?php echo $__env->make('front.sub_parts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('content'); ?>

<?$title= "Online Homework Help Service for College and University Students" ?>
<?$description="$website[name] offers homework service in subjects such as business, finance, statistics and many more. Our professional homework helpers are ready to help" ?>

<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('description', $description); ?>
 <!-- header -->
<!-- slider -->
   <div class="container-fluid slider">
       <div class="row">
	      <div class="container">
		     <div class="row">
			     <div class="col-sm-6 col-md-7 left">
				   <h1>Online Homework Help Is Here For You</h1>
				   <p>No need to strain yourself to death! Ask online homework help on any subject: from essays and assignments to research papers and dissertations.</p>
				 </div>
			     <div class="col-sm-6 col-md-5 right">
			      <div class="row">
				   <!-- form -->
				 <?php echo $__env->make('front.sub_parts.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				 <!--form -->
				 </div>
				
				 </div>
			 </div>
			 <!-- contents -->
			 <div class="row">
			     <div class="col-xs-12 contents">
				     <ul>
					    <li>Assignment Writing Help</li>
					    <li>Good Grade for All Assignments</li>
					    <li>Writing across All Subjects</li>
						<li>24/7 Online Support</li>
						<li>Confidentiality Guaranteed</li>
						<li>Plagiarism Free Papers</li>
						<li>Papers are double-checked</li>
						<li>Unlimited Revisions</li>
						<li>Professional Writers</li>
					 </ul>
				 </div>
			 </div>
			 <!-- contents -->
		  </div>
	   </div>
   </div>
  
<!-- slider -->


<!-- features -->
<div class="container-fluid features">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 contents">
				   <div class="row">
				      <div class="col-sm-4 col-xs-12 box">
					     <div class="col-xs-12">
						     <h2>35480</h2>
							 <h5>DELIVERED ORDERS</h5>
						 </div>
					  </div>
				      <div class="col-sm-4 col-xs-12 box">
					     <div class="col-xs-12">
						 <h2>211</h2>
							 <h5>OUR WRITERS</h5>
						 </div>
					  </div>
				      <div class="col-sm-4 col-xs-12 box">
					     <div class="col-xs-12">
						 <h2>9.4/10</h2>
							 <h5>CLIENT RATING</h5>
						 </div>
					  </div>
				   </div>
				   <div class="row">
				      <div class="col-xs-12">
					      <h3>Get Your Homework Completed By a Professional Expert</h3>
						  <p>Are you stressed by homework assignments? Are you unable to complete them? If this is the case, then you need homework help from professionals. You can get your homework done through online homework helper. We at <span class="color"><?php echo $website['name']; ?></span> ensure you get this service and improve your grades. You may seek assistance for any type of homework including but not limited to reports, essays, and even research papers.</p>
						  <p>As a homework writing service provider, we put more emphasis on quality and customer satisfaction. We hire writers with Masters and PhD degrees from leading universities all around the world. Our writers make every effort possible to ensure top grades for each homework order we receive, thus we end up creating a large pool of returning clients. Further, we are committed to providing homework help 24/7. What are you waiting for? Just order now and get your business or finance homework done. </p>
						  
					  </div>
					   <p class="button"><a class="btn" href="<?=url("/stud/new");?>">Hire Expert</a></p>
				   </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- features -->

<!-- section  assignment-work-->
<div class="container-fluid assignment-work">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h2>HOW IT'S WORKS</h2>
				</div>
			</div>
		    <div class="row">
			   <div class="col-xs-12 contents">
			        <div class="row">
					   <div class="col-sm-3 col-xs-12 box">
					       <div class="col-xs-12">
						     <div class="icon">
						     <img src="front/images/assignment-order-form.svg" class="icon" alt="h3">
							  <div class="step">
							   1
							   </div>
							 </div>
							 <h4>Place Your Order:</h4>
							 <p>Using the order form, place an order by submitting your requirements and deadline.</p>
							 <img src="front/images/angle-right.png" class="arrow" alt="img">
						   </div>
					   </div>
					   <div class="col-sm-3 col-xs-12 box">
					       <div class="col-xs-12">
						   <div class="icon">
						     <img src="front/images/assignment-paypal.svg" class="icon" alt="h2">
							   <div class="step">
							   2
							   </div>
							 </div>
							 <h4>Make Payment</h4>
							 <p>Make payment via PayPal and your order will be confirmed. </p>
							 <img src="front/images/angle-right.png" class="arrow" alt="img">
						   </div>
					   </div>
					   <div class="col-sm-3 col-xs-12 box">
					       <div class="col-xs-12">
						   <div class="icon">
						     <img src="front/images/assignment-writer.svg" class="icon" alt="img">
							  <div class="step">
							   3
							   </div>
							 </div>
							 <h4>Order Assigned:</h4>
							 <p>Order is confirmed and assigned to a professional writer.</p>
							 <img src="front/images/angle-right.png" class="arrow" alt="img">
						   </div>
					   </div>
					   <div class="col-sm-3 col-xs-12 box">
					       <div class="col-xs-12">
						   <div class="icon">
						     <img src="front/images/h1.png" class="icon" alt="img">
							  <div class="step">
							   4
							   </div>
							 </div>
							 <h4>Order Delivered:</h4>
							 <p>Order will be sent via email before the deadline and thereafter, you can provide feedback.</p>
						   </div>
					   </div>
					</div>
					<!-- button -->
					<div class="row">
					  <div class="col-xs-12 button">
					     <button class="btn">Order Now</button>
					  </div>
					</div>
					<!-- button -->
			   </div>
			</div>
		</div>
   </div>
</div>
<!-- section  assignment-work-->


<!-- top  essay writers -->
   <div class="container-fluid essay-writer">
      <div class="row">
	     <div class="container">
		    <div class="row">
			   <div class="col-xs-12 heading">
			      <h2>Our Homework Help Services Encompasses All Academic Levels</h2>
				  <p>Having your homework done on time is never a walk in the park and considering how much work we get on a daily basis, it may prove practically impossible.This is why you need professional homework help from the experts such as <span class="color"><?php echo $website['name']; ?></span></p>
			   </div>
			</div>
			<div class="row">
			   <div class="col-xs-12 contents">
			      <div class="row">
				    <div class="col-sm-4 col-xs-12 box">
					   <h4>Get the Best Service </h4>
					   <p><span class="color"><?php echo $website['name']; ?></span> has over 200 writers that are carefully selected to work on the most daunting of assignments. Due to the wide nature of homework types, our writers have specialized in specific subjects to give you the best.</p>
					</div>
				    <div class="col-sm-4 col-xs-12 box">
					   <h4>Choose Any Subject</h4>
					   <p>All Subjects are offered here to assist you with your homework. Don’t worry about the quality of your homework as we have 200 quality writers with expertise in all subjects including Physics, Mathematics, Biology, Chemistry, and many others.</p>
					</div>
				    <div class="col-sm-4 col-xs-12 box">
					   <h4>Connect with Our Writers Easily</h4>
					   <p>Searching for the best homework writer for your assignment has become easy with <span class="color"><?php echo $website['name']; ?></span>. All you need to do is tell us your requirement by filling the order form and you are assured of the best available writer.</p>
					</div>
				  </div>
				  <div class="row">
				    <div class="col-sm-4 col-xs-12 box">
					   <h4>Meet Tight Deadlines</h4>
					   <p>Getting your homework completed urgently is something every student desires. Here at <span class="color"><?php echo $website['name']; ?></span>, we offer super-fast services for your work.You can choose any deadline from 6 to 36 hours and get your homework completed on a priority basis.</p>
					</div>
				    <div class="col-sm-4 col-xs-12 box">
					   <h4>Use with Confidence</h4>
					   <p>We assure you that information you provide will remain anonymous as anchored in our privacy policy. You can discuss your requirements freely with the writer to get the best solution.</p>
					</div>
				    <div class="col-sm-4 col-xs-12 box">
					   <h4>Pay Safely</h4>
					   <p>Do not worry about payment methods. We work with secure payment systems like PayPal and Visa and the account details are protected by secure socket layer commonly referred us HTTPS, so you can be rest assured of safety and privacy even as you make the payments.</p>
					</div>
				  </div>
				  <div class="row">
				     <div class="col-xs-12 button">
					    <a href="<?=url("/stud/new");?>" class="btn">Place Your Order</a>
					 </div>
				  </div>
			   </div>
			</div>
		 </div>
	  </div>
   </div>
<!-- top  essay writers -->



<!-- why you choose yourweb.com-->
 <div class="container-fluid  why-us-web">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h2><span class="color"><?php echo $website['name']; ?></span> is the Answer to Your Online Homework Help</h2>
						<p> Top grade for homework is a dream for every student. However, a limited time frame would clip the ability of any student to write quality work. Therefore, getting professional help remains the only intelligent option. But one downside to seeking such help is, you cannot be assured of the quality of assignment. </p>
						<p>This enhances the anxiety of the student manifolds. The good news is, <span class="color"><?php echo $website['name']; ?></span> provides you with an opportunity to connect with a pool of writers of your choice and set yourself free from mental stress. Therefore, however complex the assignment is or tight the deadline is, all you need to do is go to <span class="color"><?php echo $website['name']; ?></span> website and tell us your requirements. You will get homework instant help as is facilitated by our highly-responsive support staff. You can seek help on any subject. </p>
						<p>We believe in the satisfaction of our customers, which is why most of our projects are tailored to individual specifications. We have also completed a huge number of projects since our inception way back in 2011. Your assignment is our duty. We strive in every possible way to make give you top grades in your homework essays. Our solutions are based on the instructions provided by students. </p>

				</div>
			</div>
		</div>
	</div>
</div>
 <!-- why you choose yourweb.com-->
 
 <div class="container-fluid why-us">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h2>Hire Homework Helper to Get Top Grades</h2>
				    <p>We provide services as per demands of the customers. To guarantee customers satisfaction, we provide a facility for direct discussion between client and our writer through a secure account. You can explain your question in detail and get unlimited revisions. </p>
					<p>At <span class="color"><?php echo $website['name']; ?></span>, we allow you to own the complete homework writing process. You can always contact your writer with any additional information in case you feel you need to add something to the ongoing assignment. </p>
					<p>For any queries, feel free to contact our customer support centre that is virtually available round the clock via call or email. They are ready to assist you at any time of day or night. Why not place your homework assignment with <span class="color"><?php echo $website['name']; ?></span> and be part of our long success story? </p>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- section  help service -->


<script src="front/js/jquery.min.js"></script>
  <script src="front/js/bootstrap.min.js"></script>
  <script src="front/js/custom.js"></script>
  <script>
var pos=$('.right').offset().top;
$(window).scroll(function(){
	2
		
		if ($(window).width() > 991)
    {
	if($(this).scrollTop()>pos){
		
		$('.slider').addClass('sticky');
		$('.top-strip').addClass('sticky');
		$('.right').addClass('sticky');
		$('.form').addClass('container');
		$('.form').removeClass('col-xs-12');
		
	}
	else{
		$('.right').removeClass('sticky')
		$('.form').removeClass('container')
		$('.form').addClass('col-xs-12')
		$('.top-strip').removeClass('sticky')
		$('.slider').removeClass('sticky')
		
	}
	}
	})
</script>

<?php echo $__env->make('client.speedy_tabs.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('front.sub_parts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldSection(); ?>	
<?php echo $__env->make('front.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>