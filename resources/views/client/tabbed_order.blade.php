@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
<ul class="nav nav-tabs">
    <li class="{{ $tab=='active' ? 'active':'' }} "><a href="{{ url("stud") }}">Active <span id="client_active"></span></a></li>
    <li class="{{ $tab=='unpaid' ? 'active':'' }}" id=""><a href="{{ url("stud/unpaid") }}">Pending <span id="client_un_payment"></span></a></li>
    <li class="{{ $tab=='disputes' ? 'active':'' }}" id=""><a href="{{ url("stud/disputes") }}">Resolution Center <span id="client_completed"></span></a></li>
    <li class="{{ $tab=='completed' ? 'active':'' }}" id=""><a href="{{ url("stud/completed") }}">Finished <span id="client_disputes"></span></a></li>
</ul>

<div class="tab-content">
    <br/>
    @include('client.tabs.'.$tab)
</div>
@endsection