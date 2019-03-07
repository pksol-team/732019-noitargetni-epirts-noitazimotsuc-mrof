<?php
$get_data = $_GET;
?>
<div id="tab_content_1" class="tab_content_form">

    <h1 style="margin-bottom: 20px">Paper information</h1>

    <div class="row form-group">
        <label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Type
            of Paper</label>
        <div class="col-xs-12 col-sm-9 col-md-8">
            <select onchange="getOrderCost();" name="document_id" label="Type of Paper" class="form-control">
                @foreach($documents as $document)
                    <option {{ @$get_data['document_id']==$document->id ? "selected":"" }} value="{{ $document->id }}">{{ $document->label }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Subject</label>
        <div class="col-xs-12 col-sm-9 col-md-8">
            <select onchange="getOrderCost();" name="subject_id"  label="Subject" class="form-control">
                @foreach($subjects as $subject)
                    <option {{ @$get_data['subject_id']==$subject->id ? "selected":"" }} value="{{ $subject->id }}">{{ $subject->label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row form-group">
        <label   class="col-xs-12 col-sm-3 col-md-4 align-left control-label">
            <span  style="position: relative;">Topic</span>
        </label>
        <div class="col-xs-12 col-sm-9 col-md-8">
            <input type="text" value="Writer Choice"  name="topic" class="form-control">
        </div>
    </div>

    <div class="row form-group">
        <label  class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Paper details</label>
        <div class="col-xs-12 col-sm-9 col-md-8">
            <textarea rows="3" name="instructions" type="text"  class="form-control" style="resize: vertical;"></textarea>
        </div>
    </div>
    <div class="row form-group">
        <label  class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Paper details</label>
        <div class="col-xs-12 col-sm-9 col-md-8">
            <div id="filesform">
                <input type="file" class="form-control" name="files[]">
            </div>
            <a onclick="return addFiles();" href="#"><i class="fa fa-plus fa-lg"></i></a>

            <script type="text/javascript">
                function addFiles(){
                    $("#filesform").append('<br/><input type="file" class="form-control" name="files[]">');
                    return false;
                }
            </script>
        </div>
    </div>

    <div class="row form-group">
        <label  class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Sources</label>
        <div class="col-xs-12 col-sm-3 col-md-4">
            <span class="input-group">
                <span  class="input-group-btn">
                    <button onclick="minusSources();" name="minus" type="button"  class="btn btn-default">−</button>
                </span>
                <input  type="number" name="sources" value="0" label="Sources" class="text-center form-control" style="padding-right: 0px;">
                <span class="input-group-btn">
                    <button onclick="addSources();" name="plus" type="button" class="btn btn-default">+</button>
                </span>
            </span>
        </div>
    </div>

    <div class="form-group  row">
        <label class="control-label col-xs-12 col-sm-3 col-md-4 align-left">
            <span>Paper Format</span>
        </label>
        <div class="col-xs-12 col-sm-9 col-md-8">
            <div onchange="getOrderCost();" type="select" class="ButtonGroup btn-group btn-group-justified">
                <?php  $style_id = $styles[0]->id ?>
                @foreach($styles as $style)
                    <a id="style_no_{{ $style->id }}" onclick="return changeStyle({{ $style->id }});" href="#" class="btn btn-default style_button {{ $style->id == $style_id ? 'active':'' }}" role="button">{{ $style->label }}</a>
                @endforeach
                <input type="hidden" name="style_id" value="{{ $style_id }}">
            </div>
        </div>
    </div>
    <div class="row form-group"><label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">&nbsp;</label>
        <div class="col-xs-12 col-sm-9 col-md-7">
            <div class="step2_total_price_block step2_total_price_place">
                <p>
                    Grand total price:
                    <span id="" class="total-price-sum total_price total_price_box total_price_box_full">$14.00</span>
                </p>
            </div>
        </div>
    </div>
    <div class="form-group  row">
        <label class="control-label col-xs-12 col-sm-3 col-md-4 align-left">
            <span>&nbsp;</span>
        </label>
        <div class="col-xs-12 col-sm-9 col-md-8">
                <div  class="nextButton"
                      style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; display: inline-block; min-width: 100%;">
                    <button onclick="switchFormTab(2)" id="step-2-fwd" tabindex="0" type="button"
                            style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: inherit; font-weight: inherit; transform: translate(0px, 0px); position: relative; height: 36px; line-height: 36px; width: 100%; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; background-color: rgb(51, 122, 183); text-align: center;">
                        <div>
                            <div style="height: 36px; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">
                                <span style="position: relative; opacity: 1; font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Price Calculation &gt;</span>
                            </div>
                        </div>
                    </button>
                </div>
        </div>
    </div>

</div>
