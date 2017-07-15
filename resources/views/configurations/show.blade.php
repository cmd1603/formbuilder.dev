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
		 	<div class="col-xs-9 col-sm-11 col-md-11 col-lg-11">		
	 			<p>{{ $configuration->configuration }}</p>
	 		</div>	
	 		
	 	</div>
	</div> 	
 </div>	
 @stop