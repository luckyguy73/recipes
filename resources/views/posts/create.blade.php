@extends('layouts.master')
@section('content')
	<div class="col-sm-8">
	<h1>Post a Recipe</h1>
		<form action="{{ route('posts.store') }}" method="post">
			{{ csrf_field() }}		
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label">Recipe Title</label>
				<input type="text" name="title" id="title" class="form-control" placeholder="enter blog title" value="{{ old('title') }}">
				@if ($errors->has('title'))
					<span class="help-block alert alert-danger">
						<strong>{{ $errors->first('title') }}</strong>
					</span>
				@endif	
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group{{ $errors->has('ingredients') ? ' has-error' : '' }}">
						<label for="ingredients" class="control-label">Ingredients</label>
						<textarea name="ingredients" id="ingredients" cols="20" rows="15" class="form-control" placeholder="type min of 5 characters">{{ old('ingredients') }}</textarea>
						@if ($errors->has('ingredients'))
							<span class="help-block alert alert-danger">
								<strong>{{ $errors->first('ingredients') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group{{ $errors->has('directions') ? ' has-error' : '' }}">
						<label for="directions" class="control-label">Directions</label>
						<textarea name="directions" id="directions" cols="20" rows="15" class="form-control" placeholder="type min of 5 characters">{{ old('directions') }}</textarea>
						@if ($errors->has('directions'))
							<span class="help-block alert alert-danger">
								<strong>{{ $errors->first('directions') }}</strong>
							</span>
						@endif
						
					</div>
				</div>
			</div>
			<div><strong>Choose up to 3 tags</strong></div>
			<br>
			<div class="panel form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
					<label class="control-label checkbox-inline panel-body" for="tag">
						@foreach($tags as $tag)
							<div class="col-sm-3">
								<input type="checkbox" name="tag[{{$tag->name}}]" value="{{ $tag->id }}"
									@if(array_key_exists($tag->name, old('tag', [])))
										checked
									@endif 
								>{{ $tag->name }}
							</div>
						@endforeach
					</label>	
				@if ($errors->has('tag'))
					<span class="help-block alert alert-danger">
						<strong>{{ $errors->first('tag') }}</strong>
					</span>
				@endif	
			</div>
			<div class="form-group panel panel-body">
				<label for="image">File input</label>
				<input type="file" id="image">
				<p class="help-block">Upload photo of your recipe here.</p>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li><strong>{{ $error }}</strong></li>
						@endforeach
					</ul>
				</div>
			@endif
		</form>
	</div>
@stop