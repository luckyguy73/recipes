@foreach ($posts as $post)
	<div class="blog-post panel panel-body">
		<h2 class="blog-post-title"><a href="{{ route('posts.show', [$post]) }}">{{ ucwords($post->title) }}</a></h2>
		<p class="blog-post-meta">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
	</div><!-- /.blog-post -->
@endforeach