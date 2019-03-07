<?php $get_data = $_GET; ?>
<div style="padding: 20px;display:none;" id="tab_content_2" class="tab_content_form">
    @if(!Auth::user())
        <div id="registration_tab">
            @include('client.speedy_tabs.register_form')
        </div>

    @else
    <div>
        <div class="row form-group">
            <label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Academic
                Level</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
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
        <div class="row form-group"><label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Deadline</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                <select onchange="getOrderCost();" name="rate_id" label="Deadline" class="form-control">

                </select>
            </div>
        </div>
        <span></span>

        <div class="row form-group">
            <label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Pages</label>
            <div class="col-xs-12 col-sm-3 col-md-4"><span class="input-group"><span class="input-group-btn"><button
                                name="minus" onclick="minusPages()" type="button" class="btn btn-default">−</button></span><input name="pages" type="number"
                                                                                                           value="{{ @$_GET['pages'] > 0 ? $_GET['pages']:1  }}"
                                                                                                           label="Pages"
                                                                                                           class="text-center form-control"
                                                                                                           style="padding-right: 0px;"><span
                            class="input-group-btn"><button onclick="addPages();" name="plus" type="button" class="btn btn-default">+</button></span></span><span
                        class="help-block"><span style="font-size: 12px;"><span id="words_total_qty">1100</span>
                        words</span></span></div>
        </div>

        <div class="form-group  row" style="text-transform: uppercase;">
            <label  class="control-label col-xs-12 col-sm-3 col-md-4 align-left"><span>Spacing</span></label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                <div type="select" value="118" label="Spacing" class="ButtonGroup btn-group btn-group-justified">
                    <a onclick="selectSingle();"  href="#" class="btn btn-default single-spacing" role="button">single</a>
                    <a onclick="selectDouble();" value="118" href="#" class="btn btn-default active double-spacing" role="button">double</a>
                <input type="hidden" name="spacing" value="2">
                </div>
            </div>
        </div>
        <div class="row form-group"><label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">Language</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                <select onchange="getOrderCost();" name="language_id" label="Language" class="form-control">
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->label }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="row form-group"><label class="col-xs-12 col-sm-3 col-md-4 align-left control-label">&nbsp;</label>
            <div class="col-xs-12 col-sm-9 col-md-7">
                <div class="step2_total_price_block step2_total_price_place pull-right">
                    <p>
                        Grand total price:
                        <span id="" class="total-price-sum total_price total_price_box total_price_box_full">$14.00</span>
                    </p>
                </div>
            </div>
        </div>
        <span></span>
        <div style="margin-top: 15px;"></div>
        <div class="row">
            <div class="col-xs-4">
                <button onclick="switchFormTab(1)" id="step-2-back" tabindex="0" type="button"
                        style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: inherit; font-weight: inherit; transform: translate(0px, 0px); height: 36px; line-height: 36px; min-width: 88px; color: rgb(51, 122, 183); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; border-radius: 2px; user-select: none; position: relative; overflow: hidden; background-color: rgb(255, 255, 255); text-align: center; width: 100%;">
                    <div>
                        <span style="position: relative; padding-left: 16px; padding-right: 16px; vertical-align: middle; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; font-size: 14px;">&lt; Back</span>
                    </div>
                </button>
            </div>
            <div class="col-xs-8">
                <div  class="nextButton"
                     style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; display: inline-block; min-width: 100%;">
                    <button onclick="switchFormTab(3)" id="step-2-fwd" tabindex="0" type="button"
                            style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: inherit; font-weight: inherit; transform: translate(0px, 0px); position: relative; height: 36px; line-height: 36px; width: 100%; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; background-color: rgb(51, 122, 183); text-align: center;">
                        <div>
                            <div style="height: 36px; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">
                                <span style="position: relative; opacity: 1; font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Final step &gt;</span>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
        @endif
</div>