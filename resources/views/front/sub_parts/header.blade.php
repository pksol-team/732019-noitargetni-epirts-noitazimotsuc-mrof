<!-- top strip -->
<div class="container-fluid top-strip">
   <div class="row">
     <div class="container">
	 <div class="row">
	 <div class="col-xs-12 box">
   <p><span>Buy Assignment Online and Get a Discount UPTO 10% OFF!!! </span><a class="label label-success" href="<?=url("/stud/new")?>" >Order Now</a> <a class="label label-warning">Reviews 4.9/5/</a>

     <?php if(!Auth::user()){?>
            <a class="label label-success f-right" href="<?=url("/login");?>">Login</a> 
            <a class="label label-warning f-right" href="<?=url("/register");?>">Sign Up</a></p>
    <?php  }
     else
     {
     ?>
     <a class="label label-warning f-right" href="<?=url("/logout");?>">Logout</a>
     <a class="label label-success f-right" href="<?=url("/stud");?>">MY ACCOUNT</a> 
  <?php } ?>
   
   </div>
   </div>
   </div>
   </div>
</div>
<!-- top strip -->
<!-- header bar -->
<div class="container-fluid header">
	<div class="row">
	   <div class="container">
		  <div class="row">
 <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?=url("/");?>"><img src="{{ URL::asset('front/images/logo.png')}}" class="logo" alt="logo"></a>
    </div>
	<div class="row">
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-right navbar-nav">
          <li><a href="<?=url("/");?>" class="active">ASSIGNMENT HELP</a></li>
          <li><a href="<?=url('/services');?>">Services <span class="caret"></span></a>
		     <ul class="sub">
			       <li><a href="<?=url("/");?>">Assignment</a></li>
			       <li><a href="<?=url("/essay-writer");?>">Essay Writer</a></li>
			       <li><a href="<?=url("/case-study");?>">Case Study</a></li>
			       <li><a href="<?=url("/dissertation");?>">Dissertation</a></li>
			       <li><a href="<?=url("/homework");?>">Homework</a></li>
			       <li><a href="<?=url("/coursework");?>">Course Work</a></li>
			       <li><a href="<?=url("/research-papers");?>">Research</a></li>
			       <li><a href="<?=url("/thesis");?>">Thesis</a></li>
			 </ul>
		  </li>
          <li><a href="<?=url("/how-it-works");?>">How It Works</a></li>
          <li><a href="<?=url("/faqs");?>">Faq</a></li>
          <li><a href="<?=url("/pricing");?>">Pricing</a></li>
          <li><a href="<?=url("/guarantees");?>">Guarantees</a></li>
          <li><a href="<?=url("/blog");?>">Blog</a></li>
          <!--<li><a href="#" class="btn login">Login</a></li>
          <li><a href="#" class="btn sign-up">Sign Up</a></li>-->
       </ul>
       <img class="navbar-toggle cross" data-toggle="collapse" data-target="#myNavbar" src="{{ URL::asset('front/images/close.svg')}}" alt="X">
     </div>
     </div>
    </div>
  </nav>
</div>
</div>
</div>

  
</div>
<!-- header bar -->
