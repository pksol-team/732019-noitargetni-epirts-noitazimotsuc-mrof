@if(!Auth::user()->author_type && Auth::user()->role =='client' && $website->author ==1)
<div class="well col-md-10">
<form method="post" action="{{ url('stud/e-wallet') }}">
{{ csrf_field() }}
Hey <strong>{{ Auth::user()->name}}</strong> would you like to earn from your articles?
<div class="">
	<input required type="radio" name="author_type" value="2"><strong>Earn $50 per 300 posts</strong>
</div>
<div class="">
	<input required type="radio" name="author_type" value="1"></option><strong>Earn 10 Redeemable points by article visits(Default)</strong>
</div>
<div class="">
		<input class="btn btn-info btn-sm" type="submit" value="Save">

</div>
</div>

</form>

@endif
<div class="row"></div>