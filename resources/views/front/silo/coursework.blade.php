@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "Buy Coursework Online | Cheap Coursework Writing Service" ?>
<?$description="Buy coursework online and forget about your problems. Our writing service is available for students from any part of the world." ?>

@section('title',$title)
@section('description', $description)
 <!-- header -->
<!-- slider -->
   <div class="container-fluid slider">
       <div class="row">
	      <div class="container">
		     <div class="row">
			     <div class="col-sm-6 col-md-7 left">
				   <h1>DO YOU OFFER COURSEWORK WRITING SERVICE?</h1>
				   <p>Yes, the 200+ advanced experts at <span class=“color”><?php echo $website['name']; ?></span> can certainly help you.</p>
				 </div>
			     <div class="col-sm-6 col-md-5 right">
			      <div class="row">
				   <!-- form -->
				 @include('front.sub_parts.form')
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
					      <h3>Professional Coursework Writing Help By <span class=“color”><?php echo $website['name']; ?></span></h3>
						  <p>We provide writing services to students, both academic and non-academic from all over the world. Are you a student struggling with your coursework? Subscribe to our services and we will do the work for you. Our services are relatively affordable, so don’t worry about spending a fortune on your coursework. </p>
						  <p><span class=“color”><?php echo $website['name']; ?></span> is an established academic writing services provider. We provide online help to dozens of students regarding a wide variety of subjects. Do not let your unfinished assignments bother you anymore when they can be completed by our competent writers. Rest assured that the paper will be delivered on time. We have specialists in all available disciplines and they excel in the provision of quality papers which are well formatted.</p>
						  <h3>Are You Asking Yourself, “Who Can Write My Coursework?” Look No Further</h3>
						  <p>Course writing posses the biggest challenge to top students. For you to outsmart your peers in coursework writing, a lot of research and analysis is required. Accuracy and efficiency have to be employed to ensure production of excellent papers. However, not all students have all these skills yet they want to pass their exams so badly. This is where <span class=“color”><?php echo $website['name']; ?></span> come in handy and relieve you the burden coursework. </p>
						  
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
			      <h2>GET CUSTOM ESSAYS WRITTEN BY TOP ESSAY WRITERS IN THE MARKET</h2>
				  <p><span class="color"><?php echo $website['name']; ?></span> boasts of pro-writers that are willing to serve you in all scenarios. Overwhelmed by loads of work assignments due in a short period? We are the one-stop destination for your academic problems. Rope in our best experts to get reliable content with sure success. They are well-equipped to prepare any type of essay through in-depth research. Satisfaction is our backbone when dealing with our customers. We write plagiarism free and quality content for our papers.</p>
			   </div>
			</div>
			<div class="row">
			   <div class="col-xs-12 contents">
			      <div class="row">
				    <div class="col-sm-4 col-xs-12 box">
					   <img src="front/images/choose-topic.svg"  alt="img" class="icon">
					   <h4>Choose a topic</h4>
					   <p>The key to writing an interesting essay and fetch yourself some impressive grades is choosing a topic you are interested in. This gives a boost of concentration and a wide array of ideas to write from. Writing from a topic you less interested in is a sure way of failing to put together credible points and eventually messing the whole paper and earning yourself a very poor grade. On a brighter side, <span class=“color”><?php echo $website['name']; ?></span> provides coursework help that you can subscribe to anytime</p>
					</div>
				    <div class="col-sm-4 col-xs-12 box">
					   <img src="front/images/collect-data.svg"  alt="img" class="icon">
					   <h4>Collect all the data </h4>
					   <p>Take your time when collecting data and ensure that the information you have collected is relevant and directly related to the essay you are working on. Research may be an uphill task though. We do have dedicated writers at coursework help who are more than willing to help you with research and your whole paper at large.</p>
					</div>
				    <div class="col-sm-4 col-xs-12 box">
					   <img src="front/images/ask-help.svg" alt="img" class="icon">
					   <h4>Ask for help</h4>
					   <p>Sometimes all you need to do is to ask for help. Your professor will provide you with all the clarifications you need in your coursework only if you ask. There are several hindrances to good performance in your coursework as a student: Last minute rush, writing before conducting thorough research, exceeding the laid down word limit, multitasking while writing, writing very fast without crosschecking for errors and plagiarism. It’s wise to ask someone to go through your work they may spot mistakes which you did not see.</p>
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
				   <h2>PROFESSIONAL AND AFFORDABLE ONLINE SERVICE</h2>
					<p>In any mode of academic writing, the biggest offense you can commit is plagiarism. This occurs when copying someone’s work without citing. Every time you include ideas in your work remember to state where you retrieved them from. This offense can solely lead to cancellation of your paper or suspension from your university. </p>
					<p>Coursework help can assist you with all your assignments. All the students who have tried our services come back for more and on most occasions, they bring tag their friends along. Basically, we handle all sorts of assignment from around the globe and we have perfected the art of delivering top quality assignments to our students long before the stipulated deadline. We value confidentiality and we don’t expose our client’s information. Your assignment is delivered to your email and you have enough time to check it and raise any concerns which our team of experts is always more than ready to tackle and resolve. </p>
					<p>Our team of writers comprises of former tutors and seasoned writers who have bequeathed invaluable knowledge in diverse disciplines. These experts are readily available at any time to tackle your coursework paper. They conduct research on your topic; carefully compile the findings while eliminating the less important points. They then proceed to write the final paper which is proofread to check any errors. Citations and formatting are put in place while adhering to all the instructions. The final copy is also checked for plagiarism before it is channeled to your email. </p>
					<p>At <span class=“color”><?php echo $website['name']; ?></span>, we ensure that your paper is answered as per the requirements. Our writers research thoroughly and lay down good plans for the paper before the commencement of writing. Once all the data is pooled together, proper editing is carried out to give the paper the perfection it requires. These writers at <span class=“color”><?php echo $website['name']; ?></span> are experienced academic writers who are keen to details and fulfill all the paper requirements and leave no room for errors. </p>

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
				   <h2>Why You Need Our Coursework Services as a Student</h2>
				   <p>It is the desire of every student to obtain high grades in their paper. These grades affect the eventual outcome of their final grade in the course. This is why it is smart to enlist the services of site.com to give your grades a boost. Your paper will be an outstanding masterpiece once it is perfected by our experts which will earn you the top grade. Our academic writers complete all orders long before the deadline. This allows room for revisions and any adjustments you may need your paper to have.</p>
					<p>Our writers are competent and passionate about helping students with their coursework. They embark on the received assignments and write them from scratch all the way to the required word count of an exceptional original copy. We furnish you with non-plagiarized high-quality papers on your request. </p>
					<p>As a student, we are the guys you need to attain the elusive academic excellence. We will not only make your exams and coursework seem like a breeze but also ensure that you graduate with the top grade. Struggles with your coursework will become a thing of the past. All these services are rendered at an affordable fee. This implies that it won't cost you an arm and a leg to excel in your academics. Our prices have been revised to accommodate students. </p>

					<p>Don’t hesitate. Try our services and you will be impressed. </p>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- section  help service -->


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