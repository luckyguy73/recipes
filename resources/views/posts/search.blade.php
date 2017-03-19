@extends('layouts.master')

@section('content')
<div class="col-sm-8">
	@foreach ($posts as $post)
		<div class="blog-post panel panel-body">
	
			<h2 class="blog-post-title pull-left" style="clear: right;"><a href="{{ route('posts.show', [$post]) }}">{{ ucwords($post->title) }}</a></h2>
			@if (!is_null($post->image))
				<img src="{{ Storage::disk('s3')->url($post->image) }}" height="125" width="200" class="pull-right">
			@else
				<img src="{{ url('/images/default.jpeg') }}" height="125" width="200" class="pull-right">
			@endif
			<p class="blog-post-meta pull-left" style="clear: left;"><span class="text-success">{{ $post->created_at->diffForHumans() }} by </span>
				<a href="#">{{ $post->user->name }}</a></p>
			@if(count($post->tags))
				<ul class="list-inline pull-left" style="clear: left;">
				@foreach ($post->tags as $tag)
					<li>
						<a href="/posts/tags/{{ $tag->name }}"><small>{{ $tag->name }}</small> </a>
					</li>
				@endforeach
				</ul>
			@endif
	
		</div><!-- /.blog-post -->
	@endforeach
</div>
@stop
