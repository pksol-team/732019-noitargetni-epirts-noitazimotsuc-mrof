@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends('front.layouts.master')
<?$title= "Cheap Essay Help | High Quality at Affordable Price" ?>
<?$description= "Get help on cheap custom essays written based on your requirements. We offer affordable essay help and protect your privacy." ?>
@section('title',$details[0]->title)
@section('description',$details[0]->description)
 <!-- how its work -->
<div class="container-fluid gaurantees">
   <div class="row">
        <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1>{{$details[0]->main_heading}}</h1>
				</div>
			</div>
		    <div class="row">
			   <div class="col-xs-12 contents masterclass">
			   
			           @include('front.sub_parts.leftsidebar')
				 
				    <div class="col-sm-4 col-md-3 col-xs-12 sidebar-right">
					  <div class="col-xs-12 box-main">
				        {!!$details[0]->main_content !!}
					  </div>
					  @if($details[0]->order_custom_section=='1')
					  @include('front.sub_parts.ordercustom')
				      @endif
					  <div class="col-xs-12 box-main">
				        {!!$details[0]->second_content !!}
					  </div>
                         @if($details[0]->confidentiality_authenticity_section=='1')
				        @include('front.sub_parts.confidentialityauthenticity')
				        @endif
					</div>
			   </div>
			</div>
		</div>
	</div>
</div>




@endsection
@section('footer')
@include('front.sub_parts.footer')
@endsection

@show	