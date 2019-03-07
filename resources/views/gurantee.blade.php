@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "Guarantees| $website[name]" ?>
@section('title',$title)
 <!-- how its work -->
<div class="container-fluid gaurantees">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1>Guarantees</h1>
				</div>
			</div>
		    <div class="row">
			   <div class="col-xs-12 contents masterclass">
			      
				    <div class="col-sm-4 col-md-3 col-xs-12 sidebar-left">
					<div class="row">
					  <div class="col-xs-12 box">
					    <div class="row">
						  <div class="col-xs-12 buttons">
					    <a href="<?=url("/pricing")?>" class="btn">Calculate Price</a>
					    <a href="<?=url("/stud/new")?>" class="btn">Order Now</a>
					    <a href="<?=url("/register")?>" class="btn">My ACCOUNT</a>
					    
						</div>
						</div>
						 <div class="row">
							 <div class="col-xs-12 our-advantage">
							   <div class="col-xs-12">
								<h4>Our advantages</h4>
								<ul class="icon">
								   <li>Prices starting as low as <span>$13/page</span></li>
								   <li>6 hours deadline option</li>
								   <li>Professional and experienced writers</li>
								   <li>Plagiarism report for every order</li>
								   <li><span>UNLIMITED revisions</span> according to our Revision Policy</li>
								   <li>We do to choose HARD or BIG assignments</li>
								   <li><span>Affordable</span> prices and great discounts </li>
								   <li>Check Writers sample</li>
								   <li>ENL (US, UK, AU, CA) writers available</li>
								</ul>
							 </div>
							 </div>
						  </div>
					  </div>
				  </div>
				 
				  </div>
				    <div class="col-sm-4 col-md-3 col-xs-12 sidebar-right">
					  <div class="col-xs-12 box-main">
					      <p>At <span class="color"><?php echo $website['name']; ?></span>, we are bound by firm guarantees that are anchored in our terms and conditions. Taking into account you are registered in our system; you are protected by our Revision Policy Guarantee, Money Back Guarantee Policy, Privacy Policy Guarantee, Plagiarism-Free Guarantee, Terms, and Conditions. You are entitled to the above guarantees, and it is critical you acquaint yourself with them and stay updated in case there are any changes in our policies.</p>
						  <div class="row">
					   <div class="col-xs-12 box">
					      <div class="icon">
						     <img src="front/images/money-back.svg" class="icon" alt="">
						</div>
					      <h4>Money Back Guarantee</h4>
					      <p>Our Money Back Guarantee Policy gives you outright rights to request a reimbursement at any stage of your order, in case anything goes wrong. We try to accommodate problems that may arise in your end as well. We try as much as possible to ensure we have a high customer satisfaction rate. While refunds are unusual at <span class="color"><?php echo $website['name']; ?></span>, we put your interest first. It is important to understand that quality-based refunds are accessed by our dispute resolution department within two weeks while other disputes are processed in 2 days.</p>
							<a href="<?=url("/money-back-guarantee")?>">Read our Money Back Guarantee</a>
					   </div>
					   <div class="col-xs-12 box">
					      <div class="icon">
						     <img src="front/images/revision-policy.svg" class="icon" alt="">
						</div>
					      <h4>Revision Policy</h4>
					      <p>At <span class="color"><?php echo $website['name']; ?></span>, we are very proud to be a leading academic writing agency that provides high-quality academic services. Our writers are always ready to revise your paper until you are satisfied. Furthermore, we offer unlimited revisions to any type of writing ordered.</p>
							<a href="<?=url("/revision-policy")?>">Read our Revision Policy Guarantee</a>
					   </div>
					   <div class="col-xs-12 box">
					      <div class="icon">
						     <img src="front/images/privacy-policy.svg" class="icon" alt="">
						</div>
					      <h4>Privacy Policy</h4>
					      <p>At <span class="color"><?php echo $website['name']; ?></span>, we have put in measures to ensure all information we collect when you visit (https://www.<?php echo $website['home_url']; ?>) is safe. Some of the information we collect is used to enhance content for our web pages. We NEVER share or sell information stored in our database. We value all our customers thus; it’s our obligation to uphold your privacy whatsoever.</p>
							<a href="<?=url("/privacy-policy")?>">Read our Privacy Policy Guarantee</a>
					   </div>
					   <div class="col-xs-12 box">
					      <div class="icon">
						     <img src="front/images/gaurantee.svg" class="icon" alt="">
						</div>
					      <h4>Plagiarism-Free Guarantee</h4>
					      <p>At <span class="color"><?php echo $website['name']; ?></span>, our team of professional editors proofreads and checks the papers for any grammatical and plagiarism before submitting them to our customers. Each paper is verified for uniqueness using Copyscape. Copyscape is an online software that is well known for its reliability in plagiarism detection.</p>
							<a href="<?=url("/plagiarism-free-policy")?>">Read our Plagiarism-Free Guarantee Policy</a>
					  </div>
					   <div class="col-xs-12 box">
					      <div class="icon">
						     <img src="front/images/terms-conditions.svg" class="icon" alt="">
						</div>
					      <h4>Terms & Conditions</h4>
					      <p>All orders and payments received are acknowledged for personal and non-commercial use only. Writers transfer all the rights and ownership of the papers to you; this makes you the sole owner. Kindly read our terms and conditions to understand your rights and obligations.</p>
						  <a href="<?=url("/terms-conditions")?>">Read our Terms & Conditions</a>
					   </div>
                    </div>
					  </div>
				  </div>
			   </div>
			</div>
		</div>
	</div>
</div>




@endsection
@section('footer')
@include('front.sub_parts.footer')
@endsection

@show	