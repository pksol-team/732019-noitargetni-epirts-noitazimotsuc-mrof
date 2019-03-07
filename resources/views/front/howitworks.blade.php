@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "How it Works | $website[name]" ?>
@section('title',$title)

<!-- banner -->
 
   <div class="container-fluid slider how-banner">
       <div class="row">
	      <div class="container">
		     <div class="row">
			     <div class="col-sm-6 col-md-7 left">
				   
				   <h1>How It Work</h1>
				   <p>Have an assignment? We are the experts, follow the steps outlined below.</p>
				    <div class="col-sm-12 col-xs-12 feature-head">
				       <div class="row">
					     <div class="col-xs-4 box">
						    <img src="front/images/feature1.svg" class="icon" alt="img">
							<h5>24X7 Support</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="front/images/feature2.svg" class="icon" alt="img">
							<h5>100+ Subjects</h5>
						 </div>
					     <div class="col-xs-4 box">
						    <img src="front/images/feature3.svg" class="icon" alt="img">
							<h5>200+ Experts</h5>
						 </div>
					   </div>
				   </div>
				 </div>
			     <div class="col-sm-6 col-md-5 right">
			      <div class="row">
				   <!-- form -->
				   @include('front.sub_parts.form')
				 <!--form -->
				 </div>
				
				 </div>
			 </div>
			
		  </div>
	   </div>
   </div>
  

 <!-- banner -->
 
 <!-- how its work -->
<div class="container-fluid how-its-work">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1>HOW IT'S WORKS</h1>
				   <p>We are aware of the tribulations that many students face when it comes to assignment writing. Our assignment experts know how to encounter that lingering fear when it comes to submitting the best papers for your grades. The impending deadline is what worries the most. We can cope with every anxiety, every feeling of your assignments. We produce the most authentic and genuine papers to improve your grades. Your studies and professional career is so relevant to us. Place an order with us and reap the fruits of professionally written papers today! We, however, have a procedure you should follow. It is simple and easy-to-follow.</p>
				</div>
			</div>
		    <div class="row">
			   <div class="col-xs-12 contents">
			        <div class="row">
					   <div class="col-xs-12 box">
					      <div class="icon">
						     <img src="front/images/how1.svg" class="icon" alt="img">
							  <div class="step">
							   1
							   </div>
							 </div>
					      <h4>Provide Order Details</h4>
					      <p>Fill an order form available on the main page of our website. Press the “Order Now” button which will take you to the process of placing an order.</p>
					   </div>
					   <div class="col-xs-12 box">
					     <div class="icon">
						     <img src="front/images/how2.svg" class="icon" alt="img">
							  <div class="step">
							   2
							   </div>
							 </div>
					      <h4>Determine The Cost Of The Paper </h4>
					      <p>The price of the paper depends on the academic level, the type of writing, the deadline of the paper, the number of pages and the type of paper.</p>
					   </div>
					   <div class="col-xs-12 box">
					   <div class="icon">
						     <img src="front/images/how3.svg" class="icon" alt="img">
							  <div class="step">
							   3
							   </div>
							 </div>
					      <h4>Choose The Payment Method</h4>
					      <p>We have a secure system, and it is 100% safe. We use PayPal payment method which is safer. Purchase the paper of your choice, and the rest will be done instantly. All orders are assigned to writers after payment is confirmed.</p>
					   </div>
					   <div class="col-xs-12 box">
					   <div class="icon">
						     <img src="front/images/how4.svg" class="icon" alt="img">
							  <div class="step">
							   4
							   </div>
							 </div>
					      <h4>Download The Paper</h4>
					      <p>A notification will be sent to your email when your order is ready. You can now download it to Ms Word, but you have to preview it first to make sure it meets your requirements. If you feel unsatisfied, you can request a refund or revision without any hesitation as outlined in our money back guarantee policy.</p>
					   </div>
                    </div>
                </div>
            </div>
			<div class="row">
			   <div class="col-xs-12 content-footer">
			      <p>At this time, you comprehend how easy it is to place an assignment help order at <span class="color"><?php echo $website['name']; ?></span>. We guarantee high quality work. If at all you are not satisfied with the solution, we have a revision policy that gives you outright unlimited revisions. We offer unlimited revisions until you are contented. To have a taste of our services, place an order with us; we have 24/7 customer support that is at disposal to help you with your academic needs. Whenever you require assignment help, we are readily available. </p>
			   </div>
			</div>
        </div>
    </div>
</div>	
 <!-- how its work -->
@include('client.speedy_tabs.javascript')
@endsection
@section('footer')
@include('front.sub_parts.footer')
@endsection

@show	