@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="text-center">{{ ucwords($post->title) }}</h1>
			</div>
			<div class="panel-body">
				<img src="{{ Storage::disk('s3')->url($post->image) }}" class="img-responsive center-block">
				<br>
				<h3>Ingredients</h3>
				{!! nl2br(e($post->ingredients)) !!}
			</div>
			<div class="panel-body">
				<h3>Directions</h3>
				{!! nl2br(e($post->directions)) !!}
			</div>
			<div class="panel-footer">
				<small class="text-danger">{{ $post->created_at->diffForHumans() }} by <a href="#">{{ $post->user->name }}</a></small>
				@if(count($post->tags))
					<br>
					<ul class="list-inline">
					@foreach ($post->tags as $tag)
						<li>
							<a href="/posts/tags/{{ $tag->name }}"><small>{{ $tag->name }}</small> </a>
						</li>
					@endforeach
					</ul>
				@endif
			</div>
		</div>
		<ul class="list-group">
			<h3>Comments:</h3>
			@if (Auth::check())
				<form action="/posts/{{ $post->slug }}/comments" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<textarea name="body" id="body" cols="30" rows="3" class="form-control" placeholder="add a comment" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit Comment" class="btn btn-primary">
					</div>
				</form>
				<hr>
			@endif
			
			@foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $c)
				<li class="list-group-item">
					<small class="text-danger">{{ $c->created_at->diffForHumans() }} by <a href="#">{{ $c->user->name }}</a></small> <br>
					{!! nl2br(e($c->body)) !!}
				</li>
			@endforeach
		</ul>
	</div><!-- /.blog-main -->	
@stop