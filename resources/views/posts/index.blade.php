@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">
		@include('posts.post')
		{{ $posts->appends($_GET)->links() }}
	</div><!-- /.blog-main -->	
@stop

