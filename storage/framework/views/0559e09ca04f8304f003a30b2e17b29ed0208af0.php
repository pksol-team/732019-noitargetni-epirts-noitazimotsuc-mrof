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
						
						<?php if(count($services)>1): ?>
						 <div class="row">
							 <div class="col-xs-12 our-advantage">
							   <div class="col-xs-12">
									<h4>Our Services</h4>
									<?php foreach($services as $service): ?>
									<?php if($currentUri != $service->page_name): ?>
									<ul class="icon">
									  <li><a href="<?=url("$service->page_name");?>"><?php
                                       $uri=explode('/', $service->page_name);
									    if(isset($uri[1]))
									   	echo  str_replace('-', ' ', ucfirst($uri[1]));
									    else 
									   	echo str_replace('-', ' ', ucfirst($uri[0]));

									   ?></a></li>
									</ul>
									<?php endif; ?>	
									<?php endforeach; ?>								
								</div>
							 </div>
						</div>
						<?php endif; ?>
						
						
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