@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "Plagiarism Free Policy | $website[name]" ?>
@section('title',$title)
  <!-- terms -->
   <div class="container-fluid terms-conditions">
       <div class="row">
	      <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1>Plagiarism Free Policy</h1>
				</div>
			</div>
		    <div class="row">
			    <div class="col-xs-12 contents">	
					<p>Your satisfaction and safety are our top priorities, so naturally we ensure there is no plagiarism in our products before we give them to you. As soon as each paper is completed, we scan it with our plagiarism detection software. </p>
					<h4>How We Do It</h4>
					<p>Our software is constantly updated and matches all modern equivalents in terms of capacity and effectiveness. It scans all accessible internet pages for possible matches. Apart from directly copied parts, our algorithms are also capable of detecting: </p>
					<ul>
						<li>Rearranged word order and overall sentence structure</li>
						<li>Words substituted with synonyms</li>
						<li>Changes from active into passive voice and vice versa</li>
					</ul>
					<h4>Why It Is Important</h4>
					<p>Teachers and professors use plagiarism-detection tools and thus can easily detect content that is not original. We do our best to prevent these unfortunate situations and make sure you have a plagiarism-free paper where everything is properly quoted and referenced. </p>
					<h4>Found Plagiarism? We Offer Free Revisions</h4>
					<p>In the unlikely event you suspect there is plagiarism in your paper, we are ready to revise it free of charge as soon as possible, double-checking all the quotes, references, and works cited. If at that point a free revision is futile, you can request a refund, provided there is any valid evidence of non-original content in the paper, e.g. a plagiarism report from turnitin.com or links to an alleged source of plagiarism. </p>
					<p>At <span class="color"><?php echo $website['name']; ?></span>, we highly value our reputation and do our best to provide our customers with a stress-free academic assistance service. Place your order at any time. We're online 24/7 and are ready to help. </p>


				</div>
			</div>
		  </div>
	   </div>
   </div>
 <!-- terms -->




@endsection
@section('footer')
@include('front.sub_parts.footer')
@endsection

@show	