@extends('layouts.app')

@section('content')

    <h2>Create Post
      <div class="float-right">
        <a href="/posts" class="btn btn-default">Back</a>
      </div>
    </h2>
  <br>

  <?php
  $user = Auth::user();
  $name = $user->name;
  $email = $user->email;
  ?>

  {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
      {{Form::label('name','Name')}}
      {{Form::text('name','',['class' => 'form-control','placeholder' => $name, 'readonly'])}}
    </div>
    <div class="form-group">
      {{Form::label('email','Email')}}
      {{Form::text('email','',['class' => 'form-control','placeholder' => $email, 'readonly'])}}
    </div>

    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body','',[ 'class' => 'form-control','placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{Form::file('image')}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

{!! Form::close() !!}

@endsection

<style>
div.float-right {
  float: right;
}
</style>


    
