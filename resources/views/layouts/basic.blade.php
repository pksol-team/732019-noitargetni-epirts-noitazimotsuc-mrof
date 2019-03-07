<link href="{{ url("basic_files/styles.css") }}" rel="stylesheet" type="text/css">
<link href="{{ url("basic_files/bootstrap-iso.css") }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ url("js/jquery.min.js") }}"></script>
<link href="{{ url("basic_files/styles(1).css") }}" rel="stylesheet" type="text/css"
      media="screen">
<script src="{{ URL::to('js/jquery.datetimepicker.js') }}"></script>
<link href="{{ URL::to('rating/jquery.rating.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/range.css') }}" rel="stylesheet">
<script src="{{ URL::to('rating/jquery.rating.js') }}"></script>
<link rel="stylesheet" href="{{ URL::to('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ URL::to('css/chat.css') }}" media="all" rel="stylesheet" type="text/css"/>
<script src="{{ URL::to('js/star-rating.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('js/highcharts/js/highcharts.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('js/highcharts/js/highcharts-more.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('js/jquery.toaster.js') }}"></script>
<script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
<div id="main-content">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td valign="top">
                @if(Auth::user())
                <div id="myaccount_links" style="display: block;">

                    <div id="getfacts">

                        <!--<p><a href="../message/"><strong>Simple, direct message &raquo;&raquo;</strong></a></p>-->
                        <p style="padding-left:10px;"><strong>Welcome,<br/><a href="{{ url("user/profile") }}">{{ Auth::user()->name }}</a></strong></p>
                        @foreach($menus as $menu)
                            @if($menu->type=='single' && @$menu->allow_writer != 'no')
                                @if($www->designer == 1)
                                    <?php
                                    $real_label = strtolower($menu->menus->label);
                                    $real_label = str_replace('orders','projects',$real_label);
                                    $design_label = ucwords($real_label);
                                    ?>
                                    <li>
                                        <a href="{{ URL::to($menu->menus->url)  }}"><i class="fa {{ $menu->menus->icon }}"></i> {{ $design_label }}&nbsp;&nbsp;&nbsp;<span class="" id="{{ @$menu->slug }}"></span></a>
                                    </li>
                                @else
                                    <a href="{{ URL::to($menu->menus->url)  }}"><span class="{{ @$menu->class }}"> {{ $menu->menus->label }}<span class="" id="{{ @$menu->slug }}"></span></span>
                                    </a>
                                    <div class="seps_l"></div>
                                @endif
                            @endif
                        @endforeach
                        <hr>
                        <a href="{{ url("user/profile") }}"><span class="icon_account">My Profile </span></a>
                        <div class="seps_l"></div>
                        <div class="seps_l"></div>
                        <a href="{{ url("logout") }}"><span class="icon_exit">Logout </span></a>
                        <div class="seps_l"></div>

                    </div>
                </div>
                @endif
            </td>
            <td width="89%" valign="top" style="padding:0 5px;">
                <div class="bootstrap-iso" style="padding: 15px;">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
@include('includes.javascript')
@include('includes.messages')