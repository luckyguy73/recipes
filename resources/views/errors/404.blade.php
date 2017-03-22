@extends('layouts.error')
@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<h1>Whoops, something went wrong!</h1>
				<div class="text-danger" style="font-size: 2.2rem">404 Error - Sorry, page not found</div>
				<br>
				<a href="{{ route('posts.index') }}"><button class="btn btn-danger">Go Back</button></a>
			</div>
			<div class="panel-body text-center">
				<img src="/images/404.png">
			</div>
		</div>
	</div>
@stop