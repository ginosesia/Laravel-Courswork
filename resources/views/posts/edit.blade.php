@extends('layouts.app')
@section('content')
    <h2>Edit Post
      <div class="float-right">
        <a href="/posts" class="btn btn-default">Back</a>
      </div>
    </h2>
  <br>
  {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class' => 'form-control','placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',$post->name,['class' => 'form-control','placeholder' => 'Name', 'readonly'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->body,[ 'class' => 'form-control','placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{Form::file('image')}}
  </div>
      {{Form::Hidden('_method','PUT')}}
      {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
      {!! Form::close() !!}
@endsection

<style>
  div.float-right {
        float: right;
  }
</style>