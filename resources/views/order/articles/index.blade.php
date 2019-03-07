@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
           Articles
        </div>
        <div class="panel-body">
        @if(isset($user))
        <div class="alert alert-info">Viewing articles for user: <a style="color:white;font-style: large;" href="{{ url("user/view/client/$user->id") }}"> <u>{{ $user->name.' ('.$user->email.')' }}</u></a>

        </div>
        <a href="{{ url('order/articles?tab=published') }}">View All</a>
        @endif
            <ul class="nav nav-tabs">
                <li class="{{ $tab=='published' ? 'active':'' }}">
                    <a href="{{ URL::to("order/articles?tab=published&user=".@$user->id) }}">Published</a>
                </li>
                <li class="{{ $tab=='pending' ? 'active':'' }}">
                    <a href="{{ URL::to("order/articles?tab=pending&user=".@$user->id) }}">Pending</a>
                </li>
                @if($tab == 'view')
                    <li class="active">
                        <a href="{{ URL::to("order/articles/$article->id") }}">View Article#{{ $article->id }}</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                @if($tab == 'pending' || $tab == 'published')
                                @include('order.articles.tabs.pending')
                    @else
                    @include('order.articles.tabs.'.$tab)
                @endif
            </div>
        </div>
    </div>
@endsection