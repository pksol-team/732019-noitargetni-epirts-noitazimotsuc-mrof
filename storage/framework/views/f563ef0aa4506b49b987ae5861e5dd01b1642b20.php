<div>
    <div class="tab-main" style="">
        <div class="hidden-xs">
            <div class="tab-main-div" style="">
                <div style="flex: 0 0 auto;">
                    <button onclick="switchFormTab(1)" class="tab-button" tabindex="0" type="button">
                            <span class="badge-span">
                                <span id="tab_1" style="margin:8px;" class="step-badge badge active-badge">1</span>
                                Paper information
                            </span>
                    </button>
                </div>
                <div style="flex: 1 1 auto;">
                    <span class="line-btw"></span>
                </div>
                <div style="flex: 0 0 auto;">
                    <button onclick="switchFormTab(2)" class="tab-button" tabindex="0" type="button">
                            <span class="badge-span">
                                <span id="tab_2" style="margin:8px;" class="step-badge badge">2</span>
                                Price Calculation
                            </span>
                    </button>
                </div>
                <div style="flex: 1 1 auto;">
                    <span class="line-btw"></span>
                </div>
                <div style="flex: 0 0 auto;">
                    <button onclick="switchFormTab(3)"  class="tab-button" tabindex="0" type="button">
                            <span class="badge-span">
                                <span id="tab_3" style="margin:8px;" class="step-badge badge">3</span>
                                Extra Features
                            </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .control-label {
        text-align: right !important;
    }

    .badge-span{
        height: 72px;
        color: rgba(0, 0, 0, 0.870588);
        display: flex; align-items: center;
        font-size: 17px; padding-left: 14px;
        padding-right: 14px;
        font-weight: 500;
    }
    .tab-button{
        border: 10px;
        box-sizing: border-box;
        display: inline-block;
        font-family: Roboto, sans-serif;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        cursor: pointer;
        text-decoration: none;
        margin: 0px;
        padding: 6px;
        outline: none;
        font-size: inherit;
        font-weight: inherit;
        transform: translate(0px, 0px);
        background-color: transparent;
        transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
    }
    .tab-main{
        color: rgba(0, 0, 0, 0.870588);
        background-color: rgb(255, 255, 255);
        transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
        box-sizing: border-box; font-family: Roboto, sans-serif;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        box-shadow: rgba(0, 0, 0, 0.156863) 0px 3px 10px, rgba(0, 0, 0, 0.227451) 0px 3px 10px;
        border-radius: 2px;
    }
    .tab-main-div{
        display: flex;
        flex-direction: row;
        align-content: center;
        align-items: center;
        justify-content: space-between;
    }
    .line-btw{
        display: block;
        border-color: rgb(189, 189, 189);
        margin-left: -6px;
        border-top-style: solid;
        border-top-width: 1px;
    }
    .active-badge{
        background-color: rgb(0, 188, 212);
    }
</style>
<script type="text/javascript">
    function switchFormTab(no){
        jQuery(".tab_content_form").slideUp();
        jQuery("#tab_content_"+no).slideDown();
        jQuery(".step-badge").removeClass('active-badge');
        jQuery("#tab_"+no).addClass('active-badge');
    }
</script>
