@foreach ($posts as $post)
	<div class="panel panel-default">

		<h1 class="panel-heading text-center" style="clear: right;"><a href="{{ route('posts.show', [$post]) }}">{{ ucwords($post->title) }}</a></h1>
		<div class="text-success panel-body">
		@if (!is_null($post->image))
			<img src="{{ Storage::disk('s3')->url($post->image) }}" height="125" width="200" class="pull-right">
		@else
			<img src="{{ url('/images/default.jpeg') }}" height="125" width="200" class="pull-right">
		@endif
						
		<span class="pull-left" style="clear: left;margin-top: 10px;">
			<a href="#"><b>{{ $post->user->name }}</b></a>
		</span>
		<span class="pull-left" style="clear: left;margin-top: 5px;">
			{{ $post->created_at->diffForHumans() }} ∙
			
			@if(Auth::check())
				<span class="badge{{ $post->isLikedBy(Auth::user()) ? ' badge-liked' :
					 ' badge-unliked' }}"> {{ count($post->likes) }} likes </span>
				@if ($post->isLikedBy(Auth::user()))
					∙ <span class="greencheck" data-toggle="user-liked" data-placement="right" title="You liked this 😍">&#9989;</span>
				@else
					∙ <img class="likeable-p" src="/images/like.png" data-post="{{ $post->id }}">
				@endif
			@else
				<span class="badge" style="background: dodgerblue;"> {{ count($post->likes) }} likes </span>
				∙ <img class="likeable-p" src="/images/like.png" style="opacity: 0.5"
				data-toggle="message" data-placement="right" title="Please login to like this">
			@endif
			
		</span>
		@if(count($post->tags))
			<ul class="list-inline pull-left" style="clear: left;margin-top: 5px;">
			@foreach ($post->tags as $tag)
				<li>
					<a href="/posts/tags/{{ $tag->name }}">{{ $tag->name }}
					 </a>
				</li>
			@endforeach
			</ul>
		@elseif(Auth::check()) 
			@if(Auth::user()->id == $post->user_id)
				<span class="list-inline pull-left help-block" 
				style="clear: left;margin-top: 5px;"><em> ∙ <a href="
				{{ route('posts.show', [$post]) }}">Add a tag</a> ∙ </em></span>
			@endif
		@endif
	</div>
	</div><!-- /.blog-post -->
@endforeach