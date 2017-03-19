@extends('layouts.app')

@section('content')
    <div class="jumbotron">
      <div class="container">
        <h1>Delish Recipes <small style="color: hotpink;">by Belle Moda</small></h1>
        <p>These delicious recipes will make your mouth water and crave for more.</p>
        <p><a class="btn btn-primary btn-lg" href="{{ route('posts.index') }}" role="button">View Posts &raquo;</a></p>
      </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        
        </div>
    </div>
</div>
@endsection
