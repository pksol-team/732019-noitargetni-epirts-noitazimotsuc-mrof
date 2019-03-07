 <?php $get_data = $_GET; ?>
 <form method"get" action="<?=url("stud/new");?>">
   <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
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
                    @foreach($academic_levels as $academic_level)
                        <option {{ @$academic_level->id == $aca_id ? "selected":"" }} value="{{ $academic_level->id }}">{{ $academic_level->level }}</option>
                    @endforeach
                </select>
						  </div>
					   </div>
					   <div class="row">
					      <div class="col-sm-5 col-xs-12">
						    <label>TYPE OF PAPER</label>
							</div>
					      <div class="col-sm-7 col-xs-12">
						     <select onchange="getOrderCost();" name="document_id" label="Type of Paper" class="form-control">
                @foreach($documents as $document)
                    <option {{ @$get_data['document_id']==$document->id ? "selected":"" }} value="{{ $document->id }}">{{ $document->label }}</option>
                @endforeach
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
						     <input type="text" class="form-control" placeholder="Pages" name="pages" value="{{ @$_GET['pages'] > 0 ? $_GET['pages']:1  }}"
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
                @foreach($subjects as $subject)
                    <option {{ @$get_data['subject_id']==$subject->id ? "selected":"" }} value="{{ $subject->id }}">{{ $subject->label }}</option>
                @endforeach
            </select>
					   </div>

<div class="col-xs-12 col-sm-9 col-md-8" style="display: none">
            <div onchange="getOrderCost();" type="select" class="ButtonGroup btn-group btn-group-justified">
                <?php  $style_id = $styles[0]->id ?>
                @foreach($styles as $style)
                    <a id="style_no_{{ $style->id }}" onclick="return changeStyle({{ $style->id }});" href="#" class="btn btn-default style_button {{ $style->id == $style_id ? 'active':'' }}" role="button">{{ $style->label }}</a>
                @endforeach
                <input type="hidden" name="style_id" value="{{ $style_id }}">
            </div>
        </div>

         <div class="col-xs-12 col-sm-9 col-md-8" style="display: none">
                <select onchange="getOrderCost();" name="language_id" label="Language" class="form-control">
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->label }}</option>
                        @endforeach
                </select>
            </div>


  <div type="select" value="1" label="Choose your writer"
                         class="ButtonGroup btn-group btn-group-justified" style="display: none">
                        <?php $wtr_id = $writer_categories[0]->id ?>
                        @foreach($writer_categories as $writer_category)
                            <a onclick="return setWriterCategory({{ $writer_category->id }});" href="#" id="writer_category_{{ $writer_category->id }}" class="writer-categories btn btn-default {{ $writer_category->id == $wtr_id ? 'active':'' }}" role="button"><span
                                        style="white-space: normal;">
                                    <span style="font-size: 16px;">{{ $writer_category->name }}</span><hr
                                            class="border" style="margin: 10px;"><span
                                            style="font-size: 16px; font-weight: 500;">@if($writer_category->amount>0)
                                            +{{ $writer_category->inc_type!='percent' ? "$":"" }}{{ $writer_category->amount }}{{ $writer_category->inc_type=='percent' ? "%":"" }}
                                        @else

                                    @endif
                                    </span></span>
                            </a>

                        @endforeach
                    <input type="hidden" name="writer_category_id" value="{{ $wtr_id }}">
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