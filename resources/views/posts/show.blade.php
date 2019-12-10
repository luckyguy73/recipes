@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<h1>{{ ucwords($post->title) }}</h1>
				@if (Auth::check())
					@if (Auth::user()->id == $post->user_id)
						<a href="{{ route('posts.edit', [$post]) }}"><button class="btn btn-success">Edit Recipe</button></a>
						<a href="#"><button id="deleteBtn" class="btn btn-danger">Delete Recipe</button></a>
					@endif
				@endif
			</div>
			<div class="panel-body">
				@if (!is_null($post->image))
					<img src="https://drive.google.com/uc?export=view&id={{ collect(Storage::disk('google')->getAdapter()->listContents(''))->where('name', '=', $post->image)->first()['path'] }}" class="img-responsive center-block">
				@endif
				<br>
				<h3>Ingredients</h3>
				{!! nl2br(e($post->ingredients)) !!}
			</div>
			<div class="panel-body">
				<h3>Directions</h3>
				{!! nl2br(e($post->directions)) !!}
			</div>
			<div class="panel-footer">
				<span class="text-success">
				<ul class="list-unstyled" style="line-height: 2.75rem">
					<li class="user-popover"><a href="#" title="{{ $post->user->name }}" 
				data-content="Recipes Posted: {{ count($post->user->posts) }}<br>Recipes Liked: {{ count($post->likedBy($post->user)->get()) }}<br>Comments Posted: 
				{{ count($post->user->comments) }}<br>Comments Liked: 
				{{ count(App\Comment::likedBy($post->user)->get()) }}">

					<b>{{ $post->user->name }}</b></a></li>
					<li>
						{{ $post->created_at->diffForHumans() }} ∙
						
					@if(Auth::check())
						<span class="badge{{ $post->isLikedBy(Auth::user()) ? 
							' badge-liked' : ' badge-unliked' }}"> 
							{{ count($post->likes) }} likes </span>
						@if ($post->isLikedBy(Auth::user()))
							∙ <span class="greencheck" data-toggle="user-liked" data-placement="right" title="You liked this 😍">&#9989;</span>
						@else
							∙ <img class="likeable-p" src="/images/like.png"
							data-post="{{ $post->id }}">
						@endif
					@else
						<span class="badge" style="background: dodgerblue;"> 
							{{ count($post->likes) }} likes </span>
						∙ <img class="likeable-p" src="/images/like.png" style="opacity: 0.5"data-toggle="message" data-placement="right" title="Please login to like this">
					@endif

					</li>
					<li>
						@if(count($post->tags))
							<ul class="list-inline">
							@foreach ($post->tags as $tag)
								<li>
									<a href="/posts/tags/{{ $tag->name }}">{{ $tag->name }}
									 </a>
								</li>
							@endforeach
							</ul>
						@endif
					</li>
				</ul>
				</span>
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
					<span class="text-success user-popover"><a href="#" title="{{ $c->user->name }}" 
				data-content="Recipes Posted: {{ count($c->user->posts) }}<br>Recipes Liked: {{ count($post->likedBy($c->user)->get()) }}<br>Comments Posted: 
				{{ count($c->user->comments) }}<br>Comments Liked: 
				{{ count(App\Comment::likedBy($c->user)->get()) }}">
					<b>{{ $c->user->name }}</b></a></span> ∙ 
					{!! nl2br(e($c->body)) !!} <br>
					<span class="text-success">{{ $c->created_at->diffForHumans() }}

				@if(Auth::check())
					 ∙ <span class="badge{{ $c->isLikedBy(Auth::user()) ? ' badge-liked' 
					 : ' badge-unliked' }}"> {{ count($c->likes) }} likes </span>
					@if ($c->isLikedBy(Auth::user()))
						∙ <span class="greencheck" data-toggle="user-liked" data-placement="right" title="You liked this 😍">&#9989;</span>
					@else
						∙ <img class="likeable-c" src="/images/like.png" 
						data-comment="{{ $c->id }}">
					@endif
				@else
					∙ <span class="badge" style="background: dodgerblue;"> {{ count($c->likes) }} likes </span>
					∙ <img class="likeable-p" src="/images/like.png" style="opacity: 0.5"data-toggle="message" data-placement="right" title="Please login to like this">
				@endif

					</span>
				</li>
			@endforeach
		</ul>
	</div><!-- /.blog-main -->	
	<form action="{{ route('posts.destroy', [$post]) }}" method="post" class="deleteForm" id="delete-post-{{ $post->id }}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@stop