@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "Money Back Guarantee Policy | $website[name]" ?>
@section('title',$title)
  <!-- terms -->
   <div class="container-fluid terms-conditions">
       <div class="row">
	      <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1>Money Back Guarantee Policy</h1>
				</div>
			</div>
		    <div class="row">
			    <div class="col-xs-12 contents">				   
				   <p>Money Back Guarantee is the policy of refunds, which is applicable to <span class="color"><?php echo $website['name']; ?></span></p>
				   <p>The policy can be divided into 2 sections:</p>
				   <h4>Copyright Statement</h4>
				   <ul>
				      <li>Before approving the preview version of your order.</li>
				      <li>After approving the case.</li>				 
				   </ul>
				   <p>In both cases <b>if you live on the territory of the European Union and paid VAT in the process of payment transaction, you do not receive it back with a refund. You get back only the money or a percent of the price stated in the Prices section of the website. VAT is non-refundable.</b></p>
				   <h4>Before approving the paper:</h4>
				   <b>You can qualify for a 100% refund if:</b>
				   <ul>
						<li>There was a payment mistake (identical orders, double payment, etc).</li>
						<li>We are not able to provide you with a suitable writer.</li>
						<li>You don't need the paper because the deadline has passed, but it wasn't delivered to you. In this case, you don’t receive the paper and don’t have the right to use any materials that we may have sent you before on this order (does not apply to revisions).</li>
				   </ul>
				   <b>You can get 90% refund if:</b>
						<ul>
						<li>The writer has not been assigned to your order, and less than a half of the deadline passed; the payment was received, transaction and refund fees should be covered.</li>
						</ul>
				   <b>You will be eligible for a 70% refund if:</b>
						<ul>
						<li>The writer had been assigned, and less than a half of the deadline passed; the writer has already started working on your paper and should be compensated.</li>
						</ul>
				   <b>You will be able to get back 50% of your money if:</b>
					   <ul>
					   <li>The writer had been assigned to your case, and more than a half of the deadline passed.</li>
					   <li>We are not able to provide you with a writer for your revision.</li>
					   </ul>
						<p>Please note that you have 7 days to approve the paper. Time for approval is calculated automatically from the moment the last version was uploaded to your personal order page and deadline passed. After the time has passed, the paper (or the part of the paper) is approved automatically. </p>
						<p>If you are not satisfied with the overall quality of the paper you have received, you may request for a Free Revision to be made or another writer to be assigned. You can also set this order on Dispute status by contacting our Customer Support Representatives with the message "I would like to set this order on Dispute Status" and providing a detailed explanation on your personal account page. </p>
						<p>There are several important points you need to consider when setting the order on dispute: </p>
						<ul>
							<li>In case of a dispute you will have to provide strong reasons, examples to back up your claim. </li>
							<li>It will take some time to resolve the dispute: communicate with the writer, send the paper for evaluation, etc. Sometimes we may ask for additional materials or evidence to support your request. </li>
							<li>Each case is reviewed separately; every decision concerning refund is taken after careful consideration. The refund percentage is suggested independently in each case.<li>
							<li>Failure to provide the information required for dispute resolution within 14 days will result in annulment of the dispute and no refund will be possible thereafter. </li>

						</ul>
						<p>For all orders that are placed on Dispute status, you have a 14 days period to resolve the situation with the Dispute Manager. If you fail to provide required information or feedback within time provided, dispute will be closed automatically.</p>
						
						<h4>After approving the paper:</h4>
						<p>Every client can review his/her case and ask for additional corrections if necessary. However, once you press the "Approve" button, which gives you an access to an editable and printable version of the paper, you are not able to ask for any refund. By pressing the "Approve" button, you confirm that you are satisfied with the quality of the product and have no complaints about the writer's work. </p>
						<p>After pressing the "Approve" button you only have 7 days to ask for a revision. In order to do it, you have to contact our Customer Support Representatives and explain them the situation. </p>

						<p>Do not press the "Approve" button if you haven't checked the paper's quality or you are not satisfied with it. If you cannot see the preview version of your paper, contact our Customer Support Representatives and ask them for another way to see the preview of the paper. </p>

						<p><b>When asking for full refund, you don't have the right to use the paper and all the additional materials we provided you with in the course of work. All these materials become the property of our company, and we reserve the right to publish the paper online for commercial purposes. We do not keep any kind of essay databases and 'publish on-line' means that if the paper is googled or checked with any kind of anti-plagiarism software, it will link back to our website. It may also be published as content or as a sample essay. This is done to protect our writer's work in those cases when a Customer claims a refund for the paper that has already been completed.</b></p>
						<p><b>We don't guarantee any particular grade and you cannot ask for refund in case you were poorly assessed. .</b></p>



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