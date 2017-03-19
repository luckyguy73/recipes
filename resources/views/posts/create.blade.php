@extends('layouts.master')
@section('content')
	<div class="col-sm-8">
	<h1>Post a Recipe</h1>
		<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}		
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label">Recipe Title</label>
				<input type="text" name="title" id="title" class="form-control" placeholder="Enter recipe title" value="{{ old('title') }}">
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group{{ $errors->has('ingredients') ? ' has-error' : '' }}">
						<label for="ingredients" class="control-label">Ingredients</label>
						<textarea name="ingredients" id="ingredients" cols="20" rows="15" class="form-control" placeholder="Enter ingredients">{{ old('ingredients') }}</textarea>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group{{ $errors->has('directions') ? ' has-error' : '' }}">
						<label for="directions" class="control-label">Directions</label>
						<textarea name="directions" id="directions" cols="20" rows="15" class="form-control" placeholder="Enter directions">{{ old('directions') }}</textarea>
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
			</div>
			<div class="text-center form-group panel panel-body{{ $errors->has('image') ? ' has-error' : '' }}">
				<input id="uploadFile" placeholder="Upload recipe image" disabled="disabled" class="text-center" style="background: #f5f8fa; font-weight: bold;">
				<div id="fileUploadBtn" class="fileUpload btn btn-default">
				    <span>Browse</span>
				    <input id="uploadBtn" type="file" name="image" class="upload" title="Browse">
				</div>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
@stop