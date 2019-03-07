<?php if(Auth::user()): ?>
<div class=" col-md-2">
    <div class="left-main-menu">
        <div class="pre-main-menu">
            <a class="" style="text-decoration: none;" href="<?php echo e(url('stud/new')); ?>">
            <div class="desktop-dashboard-menu" style="padding: 0px; display: block; user-select: none;">
                <div id="dashboard-menu" style="opacity: 1;">
                    <div>
                        <span class="order-dash" tabindex="0" type="button" style="">
                              <i class="fa fa-plus menu-icon"></i> New Order
                        </span>
                        <hr class="menu-line">
                    </div>
                </div>
            </div>
            </a>
            <a class="" style="text-decoration: none;" href="<?php echo e(url('stud')); ?>">
            <div class="desktop-dashboard-menu" style="padding: 0px; display: block; user-select: none;">

                <div id="dashboard-menu" style="opacity: 1;">
                    <div>

                            <span class="order-dash" tabindex="0" type="button" style="">
                              <i class="fa fa-list menu-icon"></i> Orders
                        </span>


                        <hr class="menu-line">
                    </div>
                </div>

            </div>
            </a>
            <a class="" style="text-decoration: none;" href="<?php echo e(url('departments/messages')); ?>">
            <div class="desktop-dashboard-menu" style="padding: 0px; display: block; user-select: none;">
                <div id="dashboard-menu" style="opacity: 1;">
                    <div>
                        <span class="order-dash" tabindex="0" type="button" style="">
                              <i class="fa fa-envelope menu-icon"></i> Messages
                            <span id="message_count"></span>
                        </span>
                        <hr class="menu-line">
                    </div>
                </div>
            </div>
            </a>
           
            <a class="" style="text-decoration: none;" href="<?php echo e(url('user/profile')); ?>">
            <div class="desktop-dashboard-menu" style="padding: 0px; display: block; user-select: none;">
                <div id="dashboard-menu" style="opacity: 1;">
                    <div>
                        <span class="order-dash" tabindex="0" type="button" style="">
                              <i class="fa fa-cog menu-icon"></i> Settings
                        </span>
                        <hr class="menu-line">
                    </div>
                </div>
            </div>
            </a>
            <a class="" style="text-decoration: none;" href="<?php echo e(url('logout')); ?>">
            <div class="desktop-dashboard-menu" style="padding: 0px; display: block; user-select: none;">
                <div id="dashboard-menu" style="opacity: 1;">
                    <div>
                        <span class="order-dash" tabindex="0" type="button" style="">
                              <i class="fa fa-power-off menu-icon"></i> Logout
                        </span>
                        <hr class="menu-line">
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
<style type="text/css">
    .left-main-menu{
        color: rgba(0, 0, 0, 0.870588);
        background-color: rgb(255, 255, 255);
        transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
        box-sizing: border-box;
        font-family: Roboto, sans-serif;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px;
        border-radius: 2px;
    }
    .pre-main-menu{
        z-index: 1000;
        top: 0px;
        right: 0px;
        transform-origin: right center 0px;
        opacity: 1;
        transform: scaleY(1);
    }
    .order-dash{
        border: 10px;
        box-sizing: border-box;
        display: block;
        font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        cursor: pointer;
        text-decoration: none;
        margin: 0px;
        padding: 0px;
        outline: none;
        font-size: 16px;
        font-weight: inherit;
        transform: translate(0px, 0px); color: rgba(0, 0, 0, 0.870588);
        line-height: 48px;
        position: relative;
        transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
        white-space: nowrap;
        background: none;
    }
    .menu-icon{
        margin: 0 10px 0 10px;
    }
    .menu-line{
        margin: 0px !important;
        height: 1px;
        border: none;
        background-color: rgb(224, 224, 224);
    }
</style>
    <?php endif; ?>
