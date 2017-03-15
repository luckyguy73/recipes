@foreach ($posts as $post)
	<div class="blog-post">
		<h2 class="blog-post-title"><a href="{{ route('posts.show', [$post]) }}">{{ $post->title }}</a></h2>
		<p class="blog-post-meta">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
		<p>{!! nl2br(e($post->body)) !!}</p>
	</div><!-- /.blog-post -->
@endforeach