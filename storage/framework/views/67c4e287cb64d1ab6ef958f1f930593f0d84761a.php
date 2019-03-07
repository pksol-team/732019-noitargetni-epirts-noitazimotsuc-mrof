 <?php $get_data = $_GET; ?>
 <form method"get" action="<?=url("stud/new");?>">
   <!-- <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> -->
 <div class="col-xs-12 form">
  <input type="hidden" name="spacing" value="2">
					  <div class="row">
					     <div class="col-xs-12 form-header">
						 <h3>Calculate the price</h3>
						 </div>
					  </div>
					 <div class="row">
					   <div class="col-xs-12 form-contents">
					   <div class="row">
					      <div class="col-sm-5 col-xs-12">
						    <label>ACADEMIC LEVEL</label>
							
							</div>
					      <div class="col-sm-7 col-xs-12">
						      <?php
                if(isset($get_data['academic_id'])){
                $aca_id = $get_data['academic_id'];
                }else{
                $aca_id = $academic_levels[0]->id;
                }
                ?>
                <select onchange="setAcademicId(this.value)" label="Academic Level" name="academic_id" class="form-control">
                    <?php foreach($academic_levels as $academic_level): ?>
                        <option <?php echo e(@$academic_level->id == $aca_id ? "selected":""); ?> value="<?php echo e($academic_level->id); ?>"><?php echo e($academic_level->level); ?></option>
                    <?php endforeach; ?>
                </select>
						  </div>
					   </div>
					   <div class="row">
					      <div class="col-sm-5 col-xs-12">
						    <label>TYPE OF PAPER</label>
							</div>
					      <div class="col-sm-7 col-xs-12">
						     <select onchange="getOrderCost();" name="document_id" label="Type of Paper" class="form-control">
                <?php foreach($documents as $document): ?>
                    <option <?php echo e(@$get_data['document_id']==$document->id ? "selected":""); ?> value="<?php echo e($document->id); ?>"><?php echo e($document->label); ?></option>
                <?php endforeach; ?>
            </select>
						  </div>
					   </div>
					   <div class="row">
					      <div class="col-sm-5 col-xs-12">
						    <label>DEADLINE</label>
							</div>
					      <div class="col-sm-7 col-xs-12">
						     <select onchange="getOrderCost();" name="rate_id" label="Deadline" class="form-control">	
						     </select>
						  </div>
					   </div>
					   <div class="row">
					      <div class="col-sm-5 col-xs-12">
						    <label>PAGES</label>
							</div>
					      <div class="col-sm-7 col-xs-12">
						   <div class="input-group">
						   <span class="input-group-addon"><button class="minus" name="minus" onclick="minusPages()" type="button">-</button></span>
						     <input type="text" class="form-control" placeholder="Pages" name="pages" value="<?php echo e(@$_GET['pages'] > 0 ? $_GET['pages']:1); ?>"
                                                                                                           label="Pages"
                                                                                                           class="text-center form-control"
                                                                                                           >
							 <span class="input-group-addon"><button class="plus" onclick="addPages();" name="plus" type="button">+</button></span>
							 </div>
						  </div>       
                        <span
                        class="help-block" style="display: none;"><span style="font-size: 12px;"><span id="words_total_qty">1100</span>
                        words</span></span> 
					   </div>
					   <div style="display: none;">
                          <select onchange="getOrderCost();" name="subject_id"  label="Subject" class="form-control">
                <?php foreach($subjects as $subject): ?>
                    <option <?php echo e(@$get_data['subject_id']==$subject->id ? "selected":""); ?> value="<?php echo e($subject->id); ?>"><?php echo e($subject->label); ?></option>
                <?php endforeach; ?>
            </select>
					   </div>

<div class="col-xs-12 col-sm-9 col-md-8" style="display: none">
            <div onchange="getOrderCost();" type="select" class="ButtonGroup btn-group btn-group-justified">
                <?php  $style_id = $styles[0]->id ?>
                <?php foreach($styles as $style): ?>
                    <a id="style_no_<?php echo e($style->id); ?>" onclick="return changeStyle(<?php echo e($style->id); ?>);" href="#" class="btn btn-default style_button <?php echo e($style->id == $style_id ? 'active':''); ?>" role="button"><?php echo e($style->label); ?></a>
                <?php endforeach; ?>
                <input type="hidden" name="style_id" value="<?php echo e($style_id); ?>">
            </div>
        </div>

         <div class="col-xs-12 col-sm-9 col-md-8" style="display: none">
                <select onchange="getOrderCost();" name="language_id" label="Language" class="form-control">
                    <?php foreach($languages as $language): ?>
                        <option value="<?php echo e($language->id); ?>"><?php echo e($language->label); ?></option>
                        <?php endforeach; ?>
                </select>
            </div>


  <div type="select" value="1" label="Choose your writer"
                         class="ButtonGroup btn-group btn-group-justified" style="display: none">
                        <?php $wtr_id = $writer_categories[0]->id ?>
                        <?php foreach($writer_categories as $writer_category): ?>
                            <a onclick="return setWriterCategory(<?php echo e($writer_category->id); ?>);" href="#" id="writer_category_<?php echo e($writer_category->id); ?>" class="writer-categories btn btn-default <?php echo e($writer_category->id == $wtr_id ? 'active':''); ?>" role="button"><span
                                        style="white-space: normal;">
                                    <span style="font-size: 16px;"><?php echo e($writer_category->name); ?></span><hr
                                            class="border" style="margin: 10px;"><span
                                            style="font-size: 16px; font-weight: 500;"><?php if($writer_category->amount>0): ?>
                                            +<?php echo e($writer_category->inc_type!='percent' ? "$":""); ?><?php echo e($writer_category->amount); ?><?php echo e($writer_category->inc_type=='percent' ? "%":""); ?>

                                        <?php else: ?>

                                    <?php endif; ?>
                                    </span></span>
                            </a>

                        <?php endforeach; ?>
                    <input type="hidden" name="writer_category_id" value="<?php echo e($wtr_id); ?>">
                    </div>



					   </div>
					   </div>
					  
					    <div class="row">
					      <div class="col-xs-12 form-footer">
						    <div class="row">
							 <div class="col-sm-5 col-xs-12">
						    <h5>Total Price: <span class="total-price-sum total_price total_price_box total_price_box_full">$</span></h5>
							</div>
					      <div class="col-sm-7 col-xs-12">
						       <button class="btn" type="submit">Continue</button>
						  </div>
							</div>
						  
						  </div>
						</div>
				 </div>