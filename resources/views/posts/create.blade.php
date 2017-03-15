@extends('layouts.master')
@section('content')
	<div class="col-sm-8">
	<h1>Publish a Post</h1>
		<form action="{{ route('posts.store') }}" method="post">
			{{ csrf_field() }}		
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label">Title</label>
				<input type="text" name="title" id="title" class="form-control" placeholder="enter blog title" value="{{ old('title') }}">
				@if ($errors->has('title'))
					<span class="help-block alert alert-danger">
						<strong>{{ $errors->first('title') }}</strong>
					</span>
				@endif	
			</div>
			<div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
				<label for="tag" class="control-label">Choose Tags</label>
				<select name="tag" id="tag" class="form-control">
					@foreach($post->tags as $tag)
	                    @if(old('tag') == $tag->name)
	                        <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
	                    @else
	                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
	                    @endif
	                @endforeach
				</select>
				@if ($errors->has('tag'))
					<span class="help-block alert alert-danger">
						<strong>{{ $errors->first('tag') }}</strong>
					</span>
				@endif	
			</div>
			<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
				<label for="body" class="control-label">Body</label>
				<textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="type min of 5 characters">{{ old('body') }}</textarea>
				@if ($errors->has('body'))
					<span class="help-block alert alert-danger">
						<strong>{{ $errors->first('body') }}</strong>
					</span>
				@endif	
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
@stop