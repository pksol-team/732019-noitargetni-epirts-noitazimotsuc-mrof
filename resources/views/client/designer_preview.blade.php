@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    @include('client.includes.register')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Confirm Order Details are Ok.</div>
        </div>
        <div class="panel-body">
            <div class="alert alert-default col-md-13">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table align="centre" class="table">
                            <tr>
                                <th>&nbsp;</th>
                                <th style="font-size:100%;" colspan="3">
                                    <strong>Project Details</strong>
                                    <div class="pull-right">
                                        <a onclick="goBack();" class="btn btn-warning btn-sm" href="{{ URL::to("stud/new") }}"><i class="fa fa-arrow-left"></i> Back</a>
                                        <a onclick="return checkLogin();" class="btn btn-info btn-sm" href="{{ URL::to("stud/paylater/$order->id") }}"><i class="fa fa-check"></i> Place Order</a>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td><strong>Project Topic</strong></td>
                                <td colspan="3"><?php echo $order->topic; ?></td>

                            </tr>
                            <tr>
                                <td><strong>Subject</strong></td>
                                <td>{{ $order->subject->label }}</td>
                                <td><strong>Project Type</strong></td>
                                <td>{{ $order->document->label }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>Under Preview</td>
                                <td><strong>Deadline</strong></td>
                                <?php
                                    $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));

                                        ?>
                                <td>{{  $deadline->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="3"><strong>Project Instructions</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4">{{ $order->instructions }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        checkLogin();
        function checkLogin(){
            @if(!Auth::user())
        $("#register_login").modal({
                backdrop: 'static',
                keyboard: true
            });
            return false;
            @endif
        }


        function useCode(){
            var code = $("#promotion").val();
            var order_id = "{{ $order->id }}";
            var url = "{{ URL::to('promotions/search') }}";
            $.get(url,{code:code,order_id:order_id},function(data){
                var response = JSON.parse(data);
                $("#responsi").html('processing.. ');
                if(response.status){
                    $("#responsi").html('');
                    var total = parseInt($("#ttl").text());
                    var dis = 100-parseInt(response.percent);
                    var newtot = dis/100*total;
                    $("#final_total").val(newtot);
                    $("#pricediv").html('<td><strong>Total Cost</strong></td><td colspan="3" style="color:green;font-size:large;">Success! You have been awarded  <span style="color:red;">'+response.percent+'%</span> promotion on your order total.New cost is <span style="color:red;">$'+newtot.toFixed(2)+'</span> from <span style="color:red;">$'+total+'</span></td>')

                }else{
                    $("#responsi").html(response.error);
                }
            });
        }

        function goBack() {
            window.history.back();
        }

        function setPreferred(){
            $("#preffered_status").html('<span style="color:green;">Processing...</span>');
            var id = $("input[name='writer_id']").val();
            var data = {writer_id:id};
            var url = '{{ URL::to('stud/preferred_writer') }}';
            $.get(url,data,function(response){
                if(response=='true'){
                    $("#preffered_status").html('<span style="color:green;">Writer Found<i class="fa fa-check"></i></span>');
                }else{
                    $("#preffered_status").html('<span style="color:red;">Writer not found!<i class="fa fa-times"></i></span>');
                    $("input[name='writer_id']").val('');
                }
            });
        }
    </script>
@endsection