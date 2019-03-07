@extends('layouts.plain')
@section('content')
<h1>Order Your Excellent Paper</h1>
<div class="row">
<div id="order_form">
<form id="orderForm" action="{{ URL::to('/stud/new') }}" method="post" enctype="multipart/form-data" of-state="success">
    {{ csrf_field() }}
    <input type="hidden" name="preview" value="1">
    <div class="ob">
        <div class="obx">
            <div class="of-row">
                <div class="of-col-sm-7 orderform_label">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Subject: </b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Subject" title="Please choose the subject of your paper. If none of the subjects applies, choose &quot;Other Subject&quot; and provide additional information in the &quot;Details&quot; field. The more details you give us, the better."></label>                </div>
                    <div class="of-col-sm-8">

                        <select onchange="getOrderCost();"  class="paper-subject-select" name="subject_id">
                                @foreach($subjects as $subject)
                                    <option {{ @$get_data['subject_id']==$subject->id ? "selected":"" }} value="{{ $subject->id }}">{{ $subject->label }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="of-col-sm-5">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Level: </b>
                    </div>
                    <div class="of-col-sm-8">
                        <select onchange="setAcademic(this.value)" id="essayform-level_work" class="sel full" name="academic_id">
                            <?php $no=0;  ?>
                            @foreach($academic_levels as $academic_level)
                                <option value="{{ $academic_level->id }}">{{ $academic_level->level }}</option>
                                <?php $no++; ?>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="of-row">
                <div class="of-col-sm-7">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Type of work: </b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Type of work" title="Please select the type of work you need our help with. We offer any academic help from essays to dissertations. If your type is not listed here, please contact us via the live support chat and we will help you choose the most appropriate type."></label>                </div>
                    <div class="of-col-sm-8">
                        <select onchange="getOrderCost();"  id="essayform-type_of_work" class="sel full" name="document_id">
                            @foreach($documents as $document)
                                <option {{ @$get_data['document_id']==$document->id ? "selected":"" }} value="{{ $document->id }}">{{ $document->label }}</option>
                            @endforeach

                        </select>                    <div class="additional-services-list" data-aid="add_service_list">
                        </div>
                    </div>
                </div>
                <div class="of-col-sm-5">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Style:</b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Style" title="Please choose the style for your paper to be formatted in:&lt;ul&gt;&lt;li&gt;APA (American Psychological Association) is most commonly used to cite sources within the social sciences.&lt;/li&gt;&lt;li&gt;MLA (Modern Language Association) style is most commonly used to write papers and cite sources within the liberal arts and humanities.&lt;/li&gt;&lt;li&gt;Chicago/Turabian style places bibliographic citations at the bottom of a page or at the end of a paper. The Chicago and Turabian styles are most commonly thought of as note systems.&lt;/li&gt;&lt;li&gt;Harvard referencing is the preferred style of the British Standards Institution. It is used mostly in the sciences and social sciences.&lt;/li&gt;&lt;li&gt;Oxford style is also referred to as the documentary-note system.&lt;/li&gt;&lt;/ul&gt;" data-hint-anchor="s"></label>                </div>
                    <div class="of-col-sm-8">
                        <select onchange="getOrderCost()" id="essayform-language_work" class="sel full" name="style_id">
                            @foreach($styles as $style)
                                <option value="{{ $style->id }}">{{ $style->label }}</option>
                            @endforeach
                        </select>                </div>

                </div>
            </div>
            <div class="of-row">
                <div class="of-col-sm-7">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Number of pages:</b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Number of pages" title="One page is approximately 250 words. Bibliography and title page are free of charge, so you do not need to include them in the total number of pages. If your assignment cannot be measured in words/pages (computer programs, etc.) please contact our Customer Support for guidance."></label>                </div>
                    <div class="of-col-sm-8">
                        <select id="essayform-number_page" onchange="getOrderCost();"  class="sel full double-spacing" name="pages">
                            @for($i=1;$i<201;$i++)
                                <option value="{{ $i }}">{{ $i.' Pages / '.(275*$i).' Words' }}</option>
                                @endfor
                        </select>
                        <select style="display: none;" id="essayform-number_page" onchange="getOrderCost();"  class="sel full single-spacing" name="pages_double">
                            @for($i=1;$i<201;$i++)
                                <option value="{{ $i }}">{{ $i.' Pages / '.(275*$i*2).' Words' }}</option>
                                @endfor
                        </select>
                        <input type="hidden" name="spacing" value="2">
                        <div class="additional-services-list" data-aid="add_service_list">
                            <div class="add-service-item-container">
                                <div class="add-service-item" data-aid="add_service_item">
                                    <input name="EssayForm[additional_services][single_spaced]" value="0" type="hidden"><label><input onchange="setSpacing();" id="essayform-additional_services-single_spaced" name="single_spaced" value="1" data-alias="single_spaced" type="checkbox"> <span class="add-service-title">Single-spaced</span></label>                            <span class="orderform_label">
                    <label class="hint" data-hint="tooltip" data-hint-title="Single-spaced" title="If selected, final paper will have one line spacing between each line and it automatically doubles number of words per page 1 page - 500 words, 2 pages - 1000 words etc. "></label>
                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="of-col-sm-5">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Sources:</b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Sources" title="Please specify the exact number of books, journals, articles or any other sources you want the writer to use as references in your paper."></label>                </div>
                    <div class="of-col-sm-8">
                        <select id="essayform-number_of_source" class="sel full" name="sources">
                            @for($i=1;$i<101;$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor

                        </select>                </div>
                </div>
            </div>
            <div class="of-row">
                <div class="of-col-sm-7">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Preferred Writer:</b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Standard" title=""></label>                </div>
                    <div class="of-col-sm-8">
                        <select onchange="getOrderCost();"  id="essayform-standard" class="sel full" name="writer_category_id">
                            @foreach($writer_categories as $writer_category)
                                <option value="{{ $writer_category->id }}">{{ $writer_category->name }}
                                    @if($writer_category->amount>0)
                                    +{{ $writer_category->inc_type!='percent' ? "$":"" }}{{ $writer_category->amount }}{{ $writer_category->inc_type=='percent' ? "%":"" }}
                                        @endif
                                </option>
                            @endforeach
                        </select>                </div>
                </div>
                <div class="of-col-sm-5">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Language:</b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Language" title="Choose your language style. If you are not a native speaker, it might be suspicious when your paper has been suddenly written in a pure English."></label>                </div>
                    <div class="of-col-sm-8">
                        <select onchange="getOrderCost();"  id="essayform-language_style" class="sel full" name="language_id">
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="of-row">
                <div class="of-col-sm-7">
                    <div class="of-col-sm-4 orderform_label">
                        <b>Deadline in:</b>
                        <label class="hint marg-right" data-hint="tooltip" data-hint-title="Urgency" title="Please select how soon you need your paper done. It's better to give the author at least a few additional days before your deadline so that you have the time to read it over and ask for revision if needed."></label>                </div>
                    <div class="of-col-sm-8">
                        <select onchange="getOrderCost();" id="essayform-urgency" class="sel full" name="rate_id">
                            </select>
                    </div>
                </div>
                <div class="of-col-sm-5 ">
                    <div class="of-col-sm-12 mt5 orderform_label">
                        Cost per page: <span data-of="price-per-page">$23.95</span>
                    </div>
                </div>
            </div>

            <div class="of-row">
                <div class="of-col-sm-2 col-sm-2-custom orderform_label">
                    <b>Topic:</b>
                    <label class="hint marg-right" data-hint="tooltip" data-hint-title="Topic" title="This is the topic of your paper. It is very important to state your topic clearly now as you cannot change it once the writer starts working on your paper."></label>            </div>
                <div class="of-col-sm-9 col-sm-9-custom">
                    <input id="essayform-topic" class="" name="topic" maxlength="128" placeholder="Any topic (Writer's choice)" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;" value="Any topic (Writer's choice)" type="text">                <div class="text-error"></div>                <div class="of-add-services">

                    </div>
                </div>
            </div>
            <div class="of-row">
                <div class="form-group field-essayform-instruction required">
                    <div class="of-col-sm-2 col-sm-2-custom orderform_label">
                        <label class="of-label" for="essayform-instruction">Instructions</label><span class="hint2 marg-right" data-hint="tooltip" data-hint-title="Instructions" title="Use this text area to submit instructions for our team and the writer. Please try to be as detailed as possible. The more info we have about your work, the quicker we can find the best writer for your project and the sooner the writer will catch on. If you have lots of info to submit, just type in the main points."></span>
                    </div>
                    <div class="of-col-sm-9 col-sm-9-custom"><textarea id="essayform-instruction" class="form-control" name="instructions" placeholder="Type your instructions here."></textarea><grammarly-btn><div style="visibility: hidden; z-index: 2;" class="_9b5ef6-textarea_btn _9b5ef6-anonymous _9b5ef6-not_focused" data-grammarly-reactid=".0"><div class="_9b5ef6-transform_wrap" data-grammarly-reactid=".0.0"><div title="Protected by Grammarly" class="_9b5ef6-status" data-grammarly-reactid=".0.0.0">&nbsp;</div></div><span class="_9b5ef6-btn_text" data-grammarly-reactid=".0.1">Not signed in</span></div></grammarly-btn><div class="help-block"></div></div>
                </div>        </div>
            <div class="of-row">
                <div class="of-col-sm-9 ml-percent19 serv-even-padd">
                    <div class="additional-services-list" data-aid="add_service_list">
                        <div class="add-service-item-container">
                           
                                @foreach($additional_features as $feature)
                                 <div class="add-service-item" data-aid="add_service_item">
                                    <?php
                                    similar_text(strtolower($feature->name),'progressive delivery',$percent);
                                    ?>
                                    @if($percent>80)
                                            <label><input id="feature_{{ $feature->id }}"  onchange="changeFeatured({{ $feature->id }})" name="feature_ids[]" value="1" data-alias="top_writer" type="checkbox"> <span class="add-service-title" title="{{ $feature->description }}">{{ $feature->name }}</span></label>

                                        @else
                                                    <label><input  onchange="changeFeatured({{ $feature->id }})" id="feature_{{ $feature->id }}" name="feature_ids[]" value="1" data-alias="top_writer" type="checkbox"> <span class="add-service-title" title="{{ $feature->description }}">{{ $feature->name }}</span></label>

                                                        @endif
                                                        <span style="color:green;font-weight: bold;" class="feature-price">+{{ $feature->inc_type == 'money' ? "$".$feature->amount:$feature->amount."%" }}</span><br/>

 </div>
                                                        @endforeach
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="of-row">
                <div class="form-group field-essayform-file">

                    <div class="of-col-sm-2 col-sm-2-custom orderform_label"><label class="of-label" for="essayform-file">Files</label><span class="hint2 marg-right" data-hint="tooltip" data-hint-title="Files" title="You can upload max. 3 files up to 20MB per each. Additionally, you can attach 17 instruction files in Personal Area. They will be forwarded to your writer once s/he is assigned. Therefore, make sure not to attach any files containing your personal information."></span></div>
                    <div class="of-col-sm-9 col-sm-9-custom">
                        <div class="of-attach-container">
                            <div id="filesform">
                                You will be able to upload order files in order page later after placing the order
                                {{--<input type="file" class="form-control" name="files[]">--}}
                            </div>
                            {{--<button onclick="return addFiles();" type="button" class="of-attach-button" data-aid="attach_file"><i class="fa fa-plus fa-lg"></i> file</button>--}}
                        </div>
                        <script type="text/javascript">
                            function addFiles(){
                                $("#filesform").append('<input type="file" class="form-control" name="files[]">');
                                return false;
                            }
                        </script>
                        <div class="of-error-inline">
                            <span class="of-max-files-uploaded">You will be able to attach more files after the order is placed.</span>
                            <span class="of-file-error">Error. Upload your file to <a target="_blank" href="http://sendspace.com/">sendspace.com</a> and paste the link to instructions.</span>
                        </div>
                    </div>
                </div>        </div>


            <div class="of-row">
                <div class="of-col-sm-12">
                    <div class="of-col-sm-3 col-sm-3-custom orderform_label">
                        <b>Total Price:</b>
                    </div>
                    <div class="of-col-sm-9">
                        <span id="total_price" data-of="total-price" class="of-total-price">$35.13</span>
                    </div>
                </div>
            </div>
            <p class="tac">
                <input id="button" class="order-submit-button" value="Preview my order →" type="submit">
            </p>
                    </div>
    </div>
    <select style="display: none;" class="form-control" name="currency_id" id="currency_select" onchange="changeCurrency();">
        <?php foreach($currencies as $currency): ?>
        <option {{ $currency->usd_rate==1 ? "selected":"" }} value="<?php echo $currency->id ?>"><?php echo $currency->abbrev ?></option>
        <?php endforeach; ?>
    </select>
</form>
</div>
</div>
@include('client.grademiners_css')
    @include('client.grademiners_js')
    @endsection