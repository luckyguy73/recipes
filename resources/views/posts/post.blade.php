@foreach ($posts as $post)
	<div class="blog-post panel panel-body">

		<h2 class="blog-post-title pull-left"><a href="{{ route('posts.show', [$post]) }}">{{ ucwords($post->title) }}</a></h2>
		<img src="/storage/{{ $post->image }}" height="125" width="200" class="pull-right">
		<p class="blog-post-meta pull-left">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
		
	</div><!-- /.blog-post -->
@endforeach