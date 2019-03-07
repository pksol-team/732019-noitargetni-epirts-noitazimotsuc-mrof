@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <?php $c_user = Auth::user();  ?>
    <div class="panel panel-default">
        <div class="panel-heading">{{ 'Messages' }}@if(Auth::user()->role != 'client') <a href="#new_message_modal" data-toggle="modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New</a> @endif </div>
        <div class="panel-body">
            <table class="table table-condensed table-bordered">
                <thead>
                <tr>
                    @if(Auth::user()->role !='client')
                    <th>#</th>
                    <th>User</th>
                    <th>Department</th>
                        @else
                        <th>OrderID</th>
                    @endif
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr style="background-color:{{ $message->seen ? "":"#ddd" }}">
                        @if(Auth::user()->role !='client')
                        <td>{{ $message->id }}</td>
                        <td>
                        @if($c_user->role=='writer')
                                @if($c_user->id == $message->user_id)
                                Me
                            @else
                                Admin
                            @endif
                            @else
                                    {{ $message->email }}
                                @endif
                        </td>
                        <td>
                            @if($message->name)
                                {{ $message->name }}
                            @elseif($message->assign_id)
                                {{ "Room#".$message->assign_id }}
                            @else
                                N/A
                            @endif
                        </td>
                        @else
                            <td>{{ $message->order_id }}</td>
                            @endif
                        <td>
                            {!! nl2br($message->message) !!}
                        </td>
                        <td>
                            @if($message->name)
                                <a class="btn btn-primary btn-sm" href="{{ URL::to("departments/conversation/$message->department_id/$message->client_id") }}"><i class="fa fa-comment"></i> View</a>
                            @elseif($message->assign_id)
                                    <?php $assign = $message->assign ?>
                            @if(@$assign->id)
                                    @if(Auth::user()->role=='writer')
                                    <a class="btn btn-success btn-sm" href="{{ URL::to("writer/order/$assign->order_id/room/$assign->id") }}"><i class="fa fa-users"></i> Room</a>
                                     @elseif(Auth::user()->role=='admin')
                                        <a class="btn btn-success btn-sm" href="{{ URL::to("order/$assign->order_id/room/$assign->id") }}"><i class="fa fa-users"></i> Room</a>
                                     @elseif(Auth::user()->role=='client')
                                        <a class="btn btn-success btn-sm" href="{{ URL::to("order/$assign->order_id/room/$assign->id") }}"><i class="fa fa-users"></i> Room</a>
                                        @endif
                                @else
                                <?php $message->delete() ?>
                                @endif
                            @elseif($message->order_id && Auth::user()->role=='client')
                                <a class="btn btn-success btn-sm" href="{{ URL::to("/stud/order/$message->order_id") }}#o_messages"><i class="fa fa-eye"></i> View</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $messages->links() }}

        </div>
    </div>
@if($website->designer == 1)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"> Bid Messages</div>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>OrderID</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                @foreach($bid_messages as $bid_message)
                    <tr>
                        <td>{{ $bid_message->order_id }}</td>
                        <td>{{ $bid_message->message }}</td>
                       <td>
                           @if(Auth::user()->role == 'client')
                           <a class="btn btn-success btn-sm" href="{{ URL::to("/stud/order/$bid_message->order_id") }}"><i class="fa fa-eye"></i> View</a>
                            @elseif(Auth::user()->role == 'writer')
                               <a class="btn btn-success btn-sm" href="{{ URL::to("/writer/bid/$bid_message->mapper_id") }}"><i class="fa fa-eye"></i> View</a>
                           @endif
                       </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endif
    <div class="modal fade" id="new_message_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                    Message Form
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @if(Auth::user()->role=='admin')
                                <input type="hidden" name="sender" value="0">
                            <label class="control-label col-md-3">To</label>
                            <div class="col-md-6">
                                <input name="writer_id" class="form-control">
                            </div>
                                @else
                                <input type="hidden" name="sender" value="1">
                                <input name="writer_id[]" type="hidden" value="{{ Auth::user()->id }}" class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Department</label>
                            <div class="col-md-6">
                                <select class="form-control" name="department_id">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Message</label>
                            <div class="col-md-6">
                                <textarea required class="form-control" name="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            var ms = $("input[name='writer_id']").magicSuggest({
                data: '{{ URL::to('order/force_assign') }}',
                valueField: 'id',
                method:'get',
                displayField: 'email',
                required:true,
                maxSelection:1
            });
        });
    </script>
@endsection