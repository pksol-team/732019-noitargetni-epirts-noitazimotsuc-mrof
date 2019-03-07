                                <div aria-hidden="false" aria-expanded="true" role="tabpanel"
                                     class="ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-12"
                                     id="tab_services">
                                    <fieldset id="fieldset_services" class="orderform-step">
                                        <div class="table">
                                            <div id="box_academiclevel" class="row ui-buttonset" style="">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div class="mobile-tip" data-hasqtip="11"></div>
                                                    <label for="" class="left-label">Academic level:</label>
                                                </div>
                                                  <?php 
                                                        if(@$get_data['academic_id']){
                                                            $aca_id = @$get_data['academic_id'];
                                                        }else{
                                                          $aca_id = $academic_levels[0]->id;  
                                                        }
                                                            
                                                         ?>
                                                <div class="cell cell-right side_tip side_tip_academic_level">
                                                    <div class="selects visible-in-mobile" style="<?php echo e(count($academic_levels)>5 ? 'display:block !important;':''); ?>">
                                                        <select onchange="setAcademicInput();" id="mob_academiclevel" name="academic_id" class="dr-down-input" style="">
                                                            <?php foreach($academic_levels as $academic_level): ?>
                                <option <?php echo e(@$academic_level->id == $aca_id ? "selected":""); ?> value="<?php echo e($academic_level->id); ?>"><?php echo e($academic_level->level); ?></option>
                                                                <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="radios visible-in-desktop" style="<?php echo e(count($academic_levels)>5 ? 'display:none !important;':''); ?>">                                                      
                                                        <?php foreach($academic_levels as $academic_level): ?>   
                                                        <?php if($academic_level->id == $aca_id): ?>  
                                                         <input id="academic_input_<?php echo e($academic_level->id); ?>" type="radio" title="<?php echo e($academic_level->level); ?>" value="<?php echo e($academic_level->id); ?>"
                                                               name="academiclevel" class="ui-helper-hidden-accessible"
                                                               checked="checked">
                                                        <label id="academic_label_<?php echo e($academic_level->id); ?>" onclick="setAcademicId(<?php echo e($academic_level->id); ?>);" for="academic_input_<?php echo e($academic_level->id); ?>" data-hasqtip="0"
                                                               class="academic-class ui-button ui-widget ui-state-default ui-button-text-only ui-state-active"
                                                               role="button" aria-disabled="false" aria-pressed="true">
                                                            <span
                                                                    class="ui-button-text"><?php echo e($academic_level->level); ?></span>
                                                        </label>          
                                                        <?php else: ?>
                                                        <input id="academic_input_<?php echo e($academic_level->id); ?>"  type="radio" title="<?php echo e($academic_level->level); ?>" value="<?php echo e($academic_level->id); ?>"
                                                               name="academiclevel" class="ui-helper-hidden-accessible">
                                                               <label id="academic_label_<?php echo e($academic_level->id); ?>"  onclick="setAcademicId(<?php echo e($academic_level->id); ?>);"
                                                                for="academic_input_<?php echo e($academic_level->id); ?>"
                                                                class="academic-class ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left"
                                                                role="button" aria-disabled="false" aria-pressed="false">
                                                            <span class="ui-button-text"><?php echo e($academic_level->level); ?></span>
                                                        </label>                                              
                                                                                                             
                                                                <?php endif; ?>
                                                        <?php endforeach; ?>
                                                          

                                                    </div>
                                                </div>
                                            </div>
                                            <div id="box_paper_type_id" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div data-hasqtip="15" class="mobile-tip"></div>
                                                    <label for="paper_type_id" class="left-label">Type of paper
                                                        needed:</label>
                                                </div>
                                                <div aria-describedby="qtip-14" data-hasqtip="14"
                                                     class="cell cell-right side_tip side_tip side_tip_type_of_paper">
                                                    <select
                                                            style=""
                                                            name="document_id" id="paper_type_id"
                                                            class="paper-type-id f_sz_400 validate[required] dr-down-input chosen-select"
                                                            data-finder="form.select.papertypeid">
                                                            <?php foreach($documents as $document): ?>
                                    <option <?php echo e(@$get_data['document_id']==$document->id ? "selected":""); ?> value="<?php echo e($document->id); ?>"><?php echo e($document->label); ?></option>
                                <?php endforeach; ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div id="box_paper_type_id" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div data-hasqtip="15" class="mobile-tip"></div>
                                                    <label for="paper_size" class="left-label">Paper Size:</label>
                                                </div>
                                                <div aria-describedby="qtip-14" data-hasqtip="14"
                                                     class="cell cell-right side_tip side_tip side_tip_paper_size">
                                                    <select
                                                            style=""
                                                            name="paper_size" id="paper_size_id"
                                                            class="paper-type-id f_sz_400 validate[required] dr-down-input chosen-select"
                                                            data-finder="form.select.paper_size">
                                                <option>A4(British/European)</option>
                                                <option>US Letter Size</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="box_topcat_id" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div data-hasqtip="17" class="mobile-tip"></div>
                                                    <label for="" class="left-label">Subject or discipline:</label>
                                                </div>
                                                <div aria-describedby="qtip-16" data-hasqtip="16"
                                                     class="cell cell-right side_tip side_tip_discipline">
                                                    <select
                                                            style=""
                                                            name="subject_id" id="topcat_id"
                                                            class="topcat-id f_sz_400 validate[required] dr-down-input chosen-select">
                                                         <?php foreach($subjects as $subject): ?>
                                                            <option <?php echo e(@$get_data['subject_id']==$subject->id ? "selected":""); ?> value="<?php echo e($subject->id); ?>"><?php echo e($subject->label); ?></option>
                                                         <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="box_toptitle" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div data-hasqtip="19" class="mobile-tip"></div>
                                                    <label for="" class="left-label">Topic:</label>
                                                </div>
                                                <div aria-describedby="qtip-18" data-hasqtip="18"
                                                     class="cell cell-right side_tip side_tip_toptitle">
                                                    <input value="Writer choice" name="topic" id="toptitle"
                                                           class="validate[required,custom[topiclength]] f_sz_full"
                                                           maxlength="1000" type="text">
                                                </div>
                                            </div>
                                            <?php if(@Auth::user()->role == 'admrrein'): ?>
                                            <div id="box_toptitle" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div data-hasqtip="19" class="mobile-tip"></div>
                                                    <label for="" class="left-label">Order Number:</label>
                                                </div>
                                                <div aria-describedby="qtip-18" data-hasqtip="18"
                                                     class="cell cell-right side_tip side_tip_toptitle">
                                                    <input onchange="checkId();" value="<?php echo e((\App\Order::orderBy('id','desc')->first()->id+1)); ?>" name="order_number" id=""
                                                           class="validate[required,custom[topiclength]] f_sz_full"
                                                           maxlength="1000" type="text">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div id="box_paperdets" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <div data-hasqtip="21" class="mobile-tip"></div>
                                                    <label for="" class="left-label">Paper instructions:</label>
                                                </div>
                                                <div aria-describedby="qtip-20" data-hasqtip="20"
                                                     class="cell cell-right side_tip side_tip_paperdets">
                                                <textarea name="instructions" class="expand50-200 f_sz_full" rows="4"
                                                          id="instructions" placeholder="Optional field..."></textarea>
                                                </div>
                                            </div>
                                            <div id="box_min_source" class="row">
                                                <div class="cell cell-left">
                                                    <label for="" class="left-label">Sources:</label>
                                                </div>
                                                <div class="cell cell-right">
                                                    <div id="contentspinmin_source" class="contentspin clearfix">
                                                        <button onclick="minusSources();" type="button"
                                                                class="dec buttonspin ui-state-default"
                                                                data-finder="spinner.decrease.min_source"
                                                                title="Decrease">−
                                                        </button>
                                                        <input name="sources" id="min_source"
                                                               class="inc buttonspi"
                                                               maxlength="5" value="0" min="0"
                                                               data-finder="form.input.minsource" type="text">
                                                        <button onclick="addSources();" type="button" class="inc buttonspin"
                                                                data-finder="spinner.increase.min_source"
                                                                title="Increase">+
                                                        </button>
                                                    </div>
                                                    <div class="field_tip"></div>
                                                </div>
                                            </div>
                                            <div id="box_addmaterials" class="row">
                                                <div class="cell cell-left with-mobile-tip">
                                                    <label for="" class="left-label">Additional materials:</label>
                                                </div>
                                                <div aria-describedby="qtip-22" data-hasqtip="22"
                                                     class="cell cell-right cell-additional-materials side_tip side_tip_additional_materials with-mobile-tip checkbox-wrapper">
                                                    <div data-hasqtip="23" class="mobile-tip"></div>
                                                    <div id="order-customer-files-container"
                                                         class="additional_materials_files_container"
                                                         data-finder="form.container.order-customer-files-container">
                                                        <div id="filesform">
                                                            <input type="file" class="form-control" name="files[]">
                                                        </div>
                                                        <a onclick="return addFiles();" href="#"><i class="fa fa-plus fa-lg"></i></a>
                                                    </div>
                                                    <script type="text/javascript">
                                                        function addFiles(){
                                                            $("#filesform").append('<br/><input type="file" class="form-control" name="files[]">');
                                                            return false;
                                                        }
                                                    </script>

                                                </div>
                                            </div>
                                            <div id="box_paperformat" class="row ui-buttonset">
                                                <div class="cell cell-left">
                                                    <label for="" class="left-label">Paper format or citation
                                                        style:</label>
                                                </div>
                                                <div class="cell cell-right">
                                                    <div style="display: block;" class="selects visible-in-mobile">
                                                        <select onchange="setStyleInput();" 
                                                                style=""
                                                                class="dr-down-input" name="style_id"
                                                                id="mob_paperformat">
                                                                <?php foreach($styles as $style): ?>
                                    <option value="<?php echo e($style->id); ?>"><?php echo e($style->label); ?></option>
                                <?php endforeach; ?>
                                                          
                                                        </select>
                                                    </div>
                                                    <div style="display:none;" class="radios visible-in-desktop">
                                                            <?php  $style_id = $styles[0]->id ?>

                                                            <?php foreach($styles as $style): ?>

                                                            <?php if($style_id == $style->id): ?>

                                                        <input id="style_input_<?php echo e($style->id); ?>" checked="checked" class="ui-helper-hidden-accessible"
                                                               title="<?php echo e($style->label); ?>" value="<?php echo e($style->id); ?>"
                                                               name="paperformat"
                                                               type="radio"><label onclick="changeStyle(<?php echo e($style->id); ?>);" aria-pressed="true"
                                                                                   aria-disabled="false" role="button"
                                                                                   class="style_button ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-state-active"
                                                                                   for="style_input_<?php echo e($style->id); ?>"
                                                                                   id="style_label_<?php echo e($style->id); ?>"><span
                                                                    class="ui-button-text"><?php echo e($style->label); ?></span></label>


                                                                    <?php else: ?>

                                                        <input class="ui-helper-hidden-accessible" title="<?php echo e($style->label); ?>"
                                                               id="style_input_<?php echo e($style->id); ?>" value="<?php echo e($style->id); ?>" name="paperformat"
                                                               type="radio"><label onclick="changeStyle(<?php echo e($style->id); ?>);" aria-pressed="false"
                                                                                   aria-disabled="false" role="button"
                                                                                   class="style_button ui-button ui-widget ui-state-default ui-button-text-only"
                                                                                   for="style_input_<?php echo e($style->id); ?>" id="style_label_<?php echo e($style->id); ?>"><span
                                                                    class="ui-button-text"><?php echo e($style->label); ?></span></label>
                                                                    <?php endif; ?>

                                                         <?php endforeach; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="orderform-buttons f_submit_box f_submit_box_logged">
                                            <a onclick="return stepTwo();" href="javascript:void(0)"
                                               class="orderform-submit button highlight large to_step2_btn">Go to step
                                                2. Price calculation</a>
                                        </div>
                                    </fieldset>
                                </div>
