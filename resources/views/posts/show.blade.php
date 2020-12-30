@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <h3>{{$post->title}}</h3>
      <hr>
    </div>
  <div class="row">
      <div class="col-md-8">
        <div class="body_container">
          <p>{{$post->body}}
          @if($post->image != "noImage.jpg")<br><br>
            <img style="width: 60%; padding: 10px;" src="/storage/images/{{$post->image}}">
            </p>
          @endif
        </div>
      </div>
      <br>
      <div class="col-md-4" style="margin-top: 0">
        <div class="row">
          <div class="col-md-7">
            <dl class="dl-horizontal">
              <label>Url:</label>
              <p><a href="{{$post->id}}">Post link</a></p>
            </dl>
            <dl class="dl-horizontal">
              <label>Posted By:</label>
              <p>{{$post->name}}</p>
            </dl>
          </div>
          <div class="col-md-5">
            <img src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($post->email))) . "?s=50&d=wavatar"}}" class="author-post-image">
          </div>
      </div>
        <dl class="dl-horizontal">
          <label>Posted On:</label>
          <p>{{$post->created_at}}</p>
        </dl>
        @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id || Auth::user()->role == 'Admin')
        <div class="row">
          <div class="col-sm-6">
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
          </div>
          <div class="col-sm-6">
            {!!Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {{Form::close()}}
          </div>
        </div>
        @endif
        @endif
      <div class="row">
        <div class="col-sm-12">
          <a href="/posts" class="btn btn-default">Back to Posts</a>
        </div>
      </div>
    </div>
  </div>
</div>
  <hr>
    @if(count($comments) > 0)
    @foreach ($comments as $comment)
    @endforeach
    <?php 
    $numberofcomments = $comment::where('post_id', $post->id)->count();
    ?> 
    <h3 style="margin-bottom: 25px;">
      @if($numberofcomments == 1)
      {{$numberofcomments}} Comment: 
      @else
      {{$numberofcomments}} Comments: 
      @endif
    </h3>
      @foreach ($comments as $comment)
      @if($comment->post_id == $post->id)
          <div class="well" style="padding: 0">

            <div class="row">
              <div class="col-md-11">
                  <div class="comment">
                      <div class="author-info">
                        <img src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=wavatar"}}" class="author-image">
                          <div class="author-name">
                            <h4>{{$comment->name}}</h4>
                            <p class="author-time">{{$comment->created_at}}</p>  
                          </div>
                      </div>
                      <div class="comment-content">
                        {{$comment->comment}}
                      </div>
                  </div>
              </div>
              <div class="col-md-1">
                @if(!Auth::guest())
                    @if(Auth::user()->id == $comment->user_id || Auth::user()->role == 'Admin')
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" style="background: none; border: none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-close"></i></button>
                      <div class="dropdown-menu" style="padding: 12px 0 0 5px;" aria-labelledby="dropdownMenuButton">
                        {!!Form::open(['action' => ['CommentsController@destroy',$comment->id], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {{Form::close()}}
                        </div>
                    </div>
                    @endif
                @endif
              </div>  
            </div>          
          </div>
          @endif
      @endforeach
    @else
    <div class="well1" style="padding: 0">
    <div class="comment" style="text-align: center">
        <p>No comments</p>
    </div>
    </div>
    @endif
    @if(!Auth::guest())
      <div class="commentClass">
      <h4 style="margin: 0;">New Comment: </h4>
    <hr style="height: 0.5px; background: lightgray;">
      <div class="comment-form">
        {{Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST'])}}

          <div class="row">
            <?php
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            ?>
            <div class="col-md-6">
              {{Form::label('name', 'Name:')}}
              {{Form::text('name', $name, ['class' => 'form-control', 'style' => 'margin-bottom: 5px;', 'readonly'])}}
            </div>
            <div class="col-md-6">
              {{Form::label('email', 'Email:')}}
              {{Form::text('email', $email, ['class' => 'form-control', 'style' => 'margin-bottom: 5px;', 'readonly'])}}
            </div>

            <div class="col-md-12">
              {{Form::label('comment', 'Comment:')}}
              {{Form::textarea('comment', null, ['class' => 'form-control','placeholder' => 'Comment', 'rows' => '5'])}}
              <br>
              {{Form::submit('Post Comment', ['class'=>'btn btn-success btn-block'])}}
            </div>
        {{Form::close()}}
      </div>
    </div>
    @endif
<br>
</div>
@endsection

<style>

.row {
margin-top: 0px;
}

.body_container {
background: #f1f1f1;
padding: 10px;
border-width: 0.1px;
border-style: solid;
border-color: lightgray;
border-radius: 5px;
margin-right: 20px;
}

.commentClass {
background: #f1f1f1;
padding: 20px;
margin: 25px 0 40px 0;
border-width: 0.1px;
border-style: solid;
border-color: lightgray;
border-radius: 5px;
}

.dl-horizontal {
margin-bottom: 20px;
}


div.col-sm-6 {
text-align: center;
}

.btn-primary {
width: 95%;
}

.btn-default {
width: 95%;
}
.btn-danger {
width: 95%;
}
div.col-md-1 {
text-align: center;
padding-top: 10px;
margin: 0;
padding-right: 0;
}

div.col-md-5 {
padding-right: 30px;
}

.col-md-8 {
  margin-top: 20px;
}
.author-post-image  {
width: 80px;
height: 80px;
border-radius: 50%;
float: right;

}

div.col-md-4 {
  background: #f1f1f1;
  border-radius: 5px;
  padding: 20px;
  border-width: 0.1px;
  border-style: solid;
  border-color: lightgray;
}



div.comment {
margin: 5px;
padding: 12px;
}
div.well:hover {
border: none;
border-width: 0.1px;
border-style: solid;
border-color: lightgray;

}
div.well {
border: none;
border-width: 0.1px;
border-style: solid;
border-color: lightgray;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
div.well1 {
border: none;
border-width: 0.1px;
border-style: solid;
border-color: lightgray;
border-radius: 5px;
}

small {
text-align: end;
}

.author-image {
width: 50px;
height: 50px;
border-radius: 50%;
float: left;
}

.author-name {
float: left;
margin-left: 15px;

}

.comment-content {
clear: both;
margin-left: 65;
font-size: 14px;
line-height: 1.3em;
}

.author-name>h4 {
margin: 5px 0px;
}
.author-time {
font-size: 11px;
font-style: italic;
color: #aaa;
}

</style>