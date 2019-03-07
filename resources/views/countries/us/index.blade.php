@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "Write My Assignment Help Service | Order Custom Assignment Online" ?>
<?$description="$website[name] offers relatively cheap assignment writing help services. Get your custom assignments written in time, and guaranteed plagiarism free papers at affordable price." ?>

@section('title',$title)
@section('description', $description)
 <!-- header -->
 <!-- banner -->
 
   <div class="container-fluid slider full-width-form">
       <div class="row">
	      <div class="container">
		     <div class="row">
			     <div class="col-xs-12  left">
				   
				   <h1>How Its Work</h1>
				    
				 </div>
			     <div class="col-xs-12 right">
			      <div class="row">
				   <!-- form -->
				     @include('front.sub_parts.form')
				 <!--form -->
				 </div>
				
				 </div>
				 
				 <div class="col-xs-12 feature-head">
				       <div class="row">
					     <div class="col-xs-4 box">
						    <img src="<?=url("/front/images/feature1.svg");?>" class="icon" alt="img">
							<h5>24X7 Support</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="<?=url("/front/images/feature1.svg");?>" class="icon" alt="img">
							<h5>100+ Subjects</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="<?=url("/front/images/feature1.svg");?>" class="icon" alt="img">
							<h5>3000+ Phd Experts</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="<?=url("/front/images/feature1.svg");?>" class="icon" alt="img">
							<h5>3000+ Phd Experts</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="<?=url("/front/images/feature1.svg");?>" class="icon" alt="img">
							<h5>3000+ Phd Experts</h5>
						 </div>
					   </div>
				   </div>
			 </div>
			
		  </div>
	   </div>
   </div>
<!-- banner -->

<div class="container-fluid why-us">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h2>Why Should You Choose Us?</h2>
				   <p>We give the most reliable help you might need on your assignment. Australian universities are known for their academic standards. Tasks that students are given require a more in-depth research, failure to that can affect the final grade of any student. As an assignment help provider, we can take the burden of working on your multiple papers. We make sure you not only score high but also facilitate a comprehensive understanding of a particular subject.</p>
				   <p>How do I pay for assignments? This is the question many students ask themselves. To begin with, fill the assignment submission form available on our website page; make payment through PayPal only if satisfied with the quoted price on our page. After placing an order, our writers will immediately begin working on your order. In case you're not contented, we have a 100% Money Back Guarantee policy. We will refund you with 100% of the cash paid.</p>
				</div>
			</div>
		    <div class="row">
			   <div class="col-xs-12 contents">
			      <h4><span class="color"><?php echo $website['name']; ?></span> Writing Services In Australian Cities</h4>
			   </div>
			   <div class="col-xs-12 contents2">
			       <div class="row">
				       <div class="col-xs-12 col-sm-6 box">
					      <h5>Assignment Help in Australia</h5>
						  <p>We provide assignment help in Australia covering various topics. It can be coursework, thesis, dissertation and all kinds of essays. Our assistance is an excellent support to students excelling not only in their studies but also in the professional career. Our experts skills can help students get their assignments as per their preferences. We deliver standard and quality work in Australia. We are here to help anytime with the complete package. Contact us today without hesitation.</p>
					   </div>
				       <div class="col-xs-12 col-sm-6 box">
					      <h5>Melbourne Assignment Help</h5>
						  <p>Melbourne has high standard universities, and therefore the education level requires quality work. We are here whenever you need us. We have highly skilled writers who can work on your order. We will work on your task according to your requirements laid down by Melbourne universities, more specifically by your professor. Our services have been designed to cater to your needs anytime. Get in touch to get your assignment done!</p>
					   </div>
					   </div>
					  <div class="row">
				       <div class="col-xs-12 col-sm-6 box">
					      <h5>Sydney Assignment Help</h5>
						  <p>The level of competition in Sydney universities is tremendous, so what they need is quality assignments. Sydney as known is the most expensive city in Australia, but we consider students in Sydney by providing affordable services. We have professional writers in Sydney who deliver custom-made solutions to meet your needs anytime. </p>
					   </div>
				       <div class="col-xs-12 col-sm-6 box">
					      <h5>Assignment help in Brisbane</h5>
						  <p>We understand that the most significant desire of any student is to pass. You can do that by merely availing assignment assistance in Brisbane from us. We have proved our worth in providing standard papers of Brisbane students on all kinds of assignments. We are here to treat your request with high priority whenever you need.</p>
					   </div>
				   </div>
			   </div>
			</div>
		</div>
	</div>
</div>
<!-- section  help service -->


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
					      <h3>Looking for Assignment Help Online.</h3>
						  <p>Are you having problems with your assignments? Well, try our assignment help service anytime. Students are always given assignments by their professor in which they have to complete within a fixed period of time. Considering some of this assignments have tight deadlines, students at times require assignment assistance. We are here for you. Our website provides standard and quality services to its clients. We emphasize on providing satisfying papers. We ensure our customers' orders are delivered on time. Universities students are most times loaded with assignments that make them struggle, well contact us anytime. Our website can improve your GPA whenever we work for you. </p>
						  <p>We have experts that are highly skilled and experienced enough to produce a standard and quality paper. Our customer support system is available 24/7. We have a live chat where you can communicate your queries and where we make sure you obtain the best assignment help. It is evident competition is all over the internet. Not all websites are promising enough like we do. We have various guarantees like money back guarantee policy, privacy policy, and many others.</p>
						  <p class="button"><a class="btn" href="<?=url("/stud/new");?>">Hire Expert</a></p>
					  </div>
				   </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- features -->


<script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/custom.js"></script>
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

@include('client.speedy_tabs.javascript')
@endsection
@section('footer')
@include('front.sub_parts.footer')
@endsection

@show	