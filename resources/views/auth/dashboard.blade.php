@extends('layouts.master')
@section('content')

<div class="container">
    <div class="content">
        <br>
        <div>Directory</div>
        <br>
        <div> <a href="{{ url('configurations/create') }}"><i class="fa fa-fw fa-power-off"></i> Quote and Order Builder </a> </div>
        <div> <a href="{{ URL::route('auth.logout') }}"><i class="fa fa-fw fa-power-off"></i> Logout </a> </div>
    </div>
</div>
@stop