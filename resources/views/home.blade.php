@extends('layouts.app')

@section('content')
    <div class="jumbotron">
      <div class="container">
        <h1>Dodger Blue Fans</h1>
        <p>The official blog for Dodger fans across the world.</p>
        <p><a class="btn btn-primary btn-lg" href="{{ route('posts.index') }}" role="button">View Posts &raquo;</a></p>
      </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
