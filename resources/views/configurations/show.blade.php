@extends('layouts.master')
 
 @section('content')
 <div class="container">
	<div class="row"> 
	 	<h1 class="text-center">{{ $configuration->directory_label }}</h1>
	 	<div class="row">
	 		<div class="col-sm-12 col-md-12 col-lg-12">
	 			<p class="text-center">{{ $configuration->created_at->format('l, F jS Y @ h:i:s A') }}&nbsp;&nbsp;//&nbsp;&nbsp;Created By 
		 			<a href="{{ action('UserController@show', ['user_id' => $configuration->user->id]) }}">{{ $configuration->user->name }}</a>

		 			@if (Auth::check() && Auth::user()->id === $configuration->user->id)
		 				<a href="{{ action('ConfigurationsController@edit', ['id' => $configuration->id]) }}">&nbsp;&nbsp;->&nbsp;&nbsp;Edit Configuration</a>
		 			@endif
		 		</p>
		 	</div>
		 	<div class="col-md-12" style="margin-bottom: 60px">		
	 		{!!html_entity_decode($configuration->workarea_html)!!}
	 		</div>	
	 	</div>
	</div> 	
 </div>	

 <script type="text/javascript">
	$('input[type="radio"]').click(function(e){
		var me = $(this);
		var name = me.prop('name');
		  var value = me.val();
		 if(value.substr(0,1) == 'r'){
		    var pos = name.indexOf('__');
		    var pre = name.substr(0,pos)+'__';
		    $('input[type="radio"][name^="'+pre+'"][value^="r"]').each(function(index){
		      if(this.checked){
		        if(!(me.is(this))){
		          alert("Only 1 can be Required.  Changing to Optional...");
		          $('input[type="radio"][name="'+name+'"][value^="o"]').prop('checked', true);
		        }
		      }
		    });
		 }
	});

	$('.group1').prepend('<option value="">Please make a selection</option>').val('');
	$('.group3').prepend('<option value="">Please make a selection</option>').val('');	
 </script>
 @stop