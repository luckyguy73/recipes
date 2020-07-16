<?php $__env->startSection('content'); ?>
	<div class="col-sm-8 blog-main">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<h1><?php echo e(ucwords($post->title)); ?></h1>
				<?php if(Auth::check()): ?>
					<?php if(Auth::user()->id == $post->user_id): ?>
						<a href="<?php echo e(route('posts.edit', [$post])); ?>"><button class="btn btn-success">Edit Recipe</button></a>
						<a href="#"><button id="deleteBtn" class="btn btn-danger">Delete Recipe</button></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="panel-body">
				<?php if(!is_null($post->image)): ?>
					<img src="https://drive.google.com/uc?export=view&id=<?php echo e(collect(Storage::disk('google')->getAdapter()->listContents(''))->where('name', '=', $post->image)->first()['path']); ?>" class="img-responsive center-block">
				<?php endif; ?>
				<br>
				<h3>Ingredients</h3>
				<?php echo nl2br(e($post->ingredients)); ?>

			</div>
			<div class="panel-body">
				<h3>Directions</h3>
				<?php echo nl2br(e($post->directions)); ?>

			</div>
			<div class="panel-footer">
				<span class="text-success">
				<ul class="list-unstyled" style="line-height: 2.75rem">
					<li class="user-popover"><a href="#" title="<?php echo e($post->user->name); ?>" 
				data-content="Recipes Posted: <?php echo e(count($post->user->posts)); ?><br>Recipes Liked: <?php echo e(count($post->likedBy($post->user)->get())); ?><br>Comments Posted: 
				<?php echo e(count($post->user->comments)); ?><br>Comments Liked: 
				<?php echo e(count(App\Comment::likedBy($post->user)->get())); ?>">

					<b><?php echo e($post->user->name); ?></b></a></li>
					<li>
						<?php echo e($post->created_at->diffForHumans()); ?> ∙
						
					<?php if(Auth::check()): ?>
						<span class="badge<?php echo e($post->isLikedBy(Auth::user()) ? 
							' badge-liked' : ' badge-unliked'); ?>"> 
							<?php echo e(count($post->likes)); ?> likes </span>
						<?php if($post->isLikedBy(Auth::user())): ?>
							∙ <span class="greencheck" data-toggle="user-liked" data-placement="right" title="You liked this 😍">&#9989;</span>
						<?php else: ?>
							∙ <img class="likeable-p" src="/images/like.png"
							data-post="<?php echo e($post->id); ?>">
						<?php endif; ?>
					<?php else: ?>
						<span class="badge" style="background: dodgerblue;"> 
							<?php echo e(count($post->likes)); ?> likes </span>
						∙ <img class="likeable-p" src="/images/like.png" style="opacity: 0.5"data-toggle="message" data-placement="right" title="Please login to like this">
					<?php endif; ?>

					</li>
					<li>
						<?php if(count($post->tags)): ?>
							<ul class="list-inline">
							<?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<a href="/posts/tags/<?php echo e($tag->name); ?>"><?php echo e($tag->name); ?>

									 </a>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						<?php endif; ?>
					</li>
				</ul>
				</span>
			</div>
		</div>
		<ul class="list-group">
			<h3>Comments:</h3>
			<?php if(Auth::check()): ?>
				<form action="/posts/<?php echo e($post->slug); ?>/comments" method="post">
					<?php echo e(csrf_field()); ?>

					<div class="form-group">
						<textarea name="body" id="body" cols="30" rows="3" class="form-control" placeholder="add a comment" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit Comment" class="btn btn-primary">
					</div>
				</form>
				<hr>
			<?php endif; ?>
			
			<?php $__currentLoopData = $post->comments()->orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li class="list-group-item">
					<span class="text-success user-popover"><a href="#" title="<?php echo e($c->user->name); ?>" 
				data-content="Recipes Posted: <?php echo e(count($c->user->posts)); ?><br>Recipes Liked: <?php echo e(count($post->likedBy($c->user)->get())); ?><br>Comments Posted: 
				<?php echo e(count($c->user->comments)); ?><br>Comments Liked: 
				<?php echo e(count(App\Comment::likedBy($c->user)->get())); ?>">
					<b><?php echo e($c->user->name); ?></b></a></span> ∙ 
					<?php echo nl2br(e($c->body)); ?> <br>
					<span class="text-success"><?php echo e($c->created_at->diffForHumans()); ?>


				<?php if(Auth::check()): ?>
					 ∙ <span class="badge<?php echo e($c->isLikedBy(Auth::user()) ? ' badge-liked' 
					 : ' badge-unliked'); ?>"> <?php echo e(count($c->likes)); ?> likes </span>
					<?php if($c->isLikedBy(Auth::user())): ?>
						∙ <span class="greencheck" data-toggle="user-liked" data-placement="right" title="You liked this 😍">&#9989;</span>
					<?php else: ?>
						∙ <img class="likeable-c" src="/images/like.png" 
						data-comment="<?php echo e($c->id); ?>">
					<?php endif; ?>
				<?php else: ?>
					∙ <span class="badge" style="background: dodgerblue;"> <?php echo e(count($c->likes)); ?> likes </span>
					∙ <img class="likeable-p" src="/images/like.png" style="opacity: 0.5"data-toggle="message" data-placement="right" title="Please login to like this">
				<?php endif; ?>

					</span>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div><!-- /.blog-main -->	
	<form action="<?php echo e(route('posts.destroy', [$post])); ?>" method="post" class="deleteForm" id="delete-post-<?php echo e($post->id); ?>">
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('delete')); ?>

    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ashton/develop/laravel/sites/recipes/resources/views/posts/show.blade.php ENDPATH**/ ?>