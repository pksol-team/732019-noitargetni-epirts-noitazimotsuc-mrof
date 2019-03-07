@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                {{ $user->name }}
                @if($user->role=='writer')
                    <div class="pull-right">
                        @if(Auth::user()->isAllowedTo('writer_application_info'))  <a class="btn btn-info btn-sm" href="{{ URL::to("user/$user->id/application_info") }}"><i class="fa fa-info"></i> Application Info</a> @endif
                        @if(Auth::user()->isAllowedTo('writer_payments')) <a class="btn btn-success btn-sm" href="{{ URL::to("user/$user->id/payments") }}"><i class="fa fa-money"></i> Payments</a> @endif
                        @if(!$user->suspended)
                        @endif
                        @if(\App\Website::where('designer',1)->count())
                            @if(!$user->isDesigner())
                            <a onclick="runPlainRequest('{{ URL::to('user/view/writer/allow-designer') }}',{{ $user->id }},'Allow writer to view/bid and work on orders from designer website(s)')" class="btn btn-primary"><i class="fa fa-check"></i> Allow Designer</a>
                                @else
                                    <a onclick="runPlainRequest('{{ URL::to('user/view/writer/allow-designer') }}',{{ $user->id }},'Disable writer from viewing/bidding and working on orders from designer website(s)')" class="btn btn-warning"><i class="fa fa-times"></i> Disable Designer</a>
                                @endif
                         @endif
                    </div>
                 @else
                    <div class="pull-right">
                        @if($user->suspended)
                            @else
                            @if(Auth::user()->isAllowedTo('suspend_writer')) <a class="btn btn-danger btn-sm" href="{{ URL::to("user/$user->id/suspend") }}"><i class="fa fa-money"></i> Suspend User</a> @endif

                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Personal Details</div>
                    <div class="panel-body">
                        <div class="profile_pic">

                          <img src="@if($user->image) {{ URL::to($user->image) }} @else {{ URL::to('images/img.png') }} @endif " alt="..." class="img-circle profile_img">
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            @if(Auth::user()->isAllowedTo('view_email'))
                            <tr>
                                <th>E-mail</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Send Email</th>
                                <td>
                                    <form action="{{ URL::to("emails/send") }}">
                                        <input type="hidden" name="role" value="{{ $user->role }}">
                                        <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                                        <button type="submit"><i class="fa fa-envelope"></i> Email</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ ucwords($user->role) }}</td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>
                                    @if($user->author)
                                        <label class="label label-info">Yes</label>
                                        <button class="btn btn-warning btn-xs" onclick="runPlainRequest('{{ url("user/view/$user->role/author") }}',{{ $user->id }})">Revoke Author</button>
                                    @else
                                        <label class="label label-warning">No</label>
                                        <button class="btn btn-info btn-xs" onclick="runPlainRequest('{{ url("user/view/$user->role/author") }}',{{ $user->id }})">Make Author</button>

                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ ucwords($user->country) }}</td>
                            </tr>
                            @if(Auth::user()->isAllowedTo('view_phone'))
                            <tr>
                                <th>Phone</th>
                                <td>{{ ucwords($user->phone) }}</td>
                            </tr>
                            @endif
                            @if($user->role=='client')
                            <tr>
                                <th>Total Orders</th>
                                <td>{{ $user->orders()->count()  }}<a class="btn btn-info btn-xs pull-right" href="{{ URL::to("user/$user->id/orders") }}"><i class="fa fa-eye"></i> View</a> </td>
                            </tr>
                            @endif
                            @if($user->website)
                                <tr>
                                    <th>Website</th>
                                    <td>{{ $user->website->name  }} </td>
                                </tr>
                            @endif

                            @if($user->role=='writer')
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($user->status==0)
                                            Inactive
                                        @elseif($user->suspended)
                                            <p style="color: red"><i class="fa fa-times"></i>Suspended </p>
                                            <a onclick="return confirm('Are you sure?');" href="{{ URL::to("user/$user->id/activate") }}" class="btn btn-success pull-right btn-xs"><i class="fa fa-check"></i> Activate</a>

                                        @else
                                            Active
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ @$user->writerCategory->name }}<a href="#category_modal" data-toggle="modal" class="pull-right label label-info"><i class="fa fa-edit"></i> Edit</a> </td>
                                </tr>
                                @else
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($user->suspended)
                                            <p style="color: red"><i class="fa fa-times"></i>Suspended </p>
                                            <a onclick="return confirm('Are you sure?');" href="{{ URL::to("user/$user->id/activate") }}" class="btn btn-success pull-right btn-xs"><i class="fa fa-check"></i> Activate</a>

                                        @else
                                            Active
                                        @endif
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <th>Last Login</th>
                                    <?php
                                    $login = $user->devices()->orderBy('updated_at','desc')->first();
                                    // dd($login);
                                        if(!$login){
                                            $updated = $user->updated_at;
                                        }else{
                                            $updated = $login->updated_at;
                                        }
                                    $last_login = \Carbon\Carbon::createFromTimestamp(strtotime($updated));
                                    $login_time = $last_login->diffForHumans();
                                    ?>
                                    <td>{{  $login_time }}</td>
                                </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="#password_modal" class="btn btn-info" data-toggle="modal">Update Password</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">User Traits <a href="{{ URL::to("user/$user->id/add_trait") }}" class="pull-right btn btn-info"><i class="fa fa-plus"></i> ADD</a> </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Trait</th>
                                <th>Description</th>
                                <th>On</th>
                                <th>Action</th>
                            </tr>
                            @foreach($traits = $user->traits()->orderBy('id','desc')->paginate(10) as $trait)
                                <tr>
                                    <td>{{ $trait->id }}</td>
                                    <td>{{ $trait->trait }}</td>
                                    <td>{{ $trait->description }}</td>
                                    <td>{{ date('Y M d',strtotime($trait->created_at)) }}</td>
                                    <td>
                                        <a href="{{ URL::to("user/$user->id/edit_trait/$trait->id") }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @if($user->website->wallet)
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">User E-Wallet </div>
                    <div class="panel-body">
                     @include('client.e_wallet')
                    </div>
                </div>
            </div>
            @endif
            @if($user->role=='writer')
                <div class="row"></div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Writer Performance
                        </div>
                        <div class="panel-body">
                            <div id="rating_gauge" class="col-md-3">

                            </div>
                            <div id="order_stats" class="col-md-9">

                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </div>
    </div>
    @include('user.graphs')
    <div class="modal fade" role="dialog" id="password_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Update {{ $user->name }} Password<a data-dismiss="modal" class="pull-right btn-danger btn">&times;</a></div>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal ajax-post" action="{{ URL::to("user/$user->id/password") }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Confirm Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password_confirmation" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection