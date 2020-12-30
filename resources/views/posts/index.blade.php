@extends('layouts.app')

@section('content')

@if(Auth::user())
    <h2>My Posts
        <div class="float-right">
            <a href="/posts/create" class="btn btn-primary">New Post</a>
        </div>
    </h2>
    <br>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            @if(!Auth::guest())
                @if(Auth::user()->id == $post->user_id )
                    <div class="list-group">
                        <div class="list-group-item">
                            <h4> {{$post->title}}
                                {!!Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'style' => 'float: right'])}}
                                {{Form::close()}}
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-default"style="float: right; margin-right: 5px;">Edit</a>
                                <a href="/posts/{{$post->id}}" class="btn btn-primary" style="float: right; margin-right: 5px;" >Open</a>
                            </h4>
                            <small><i>{{$post->created_at}}</i><br> By <b>{{$post->name}}</b></small>
                            <br>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @else  
        <div class="well">
            <h5>No posts found</h5>
        </div>
    @endif
    <hr>
    <h2>Other Posts</h2>
    <br> 
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            @if(!Auth::guest())
                @if(Auth::user()->id != $post->user_id)
                    @if(Auth::user()->role == 'Admin')
                        <div class="list-group">
                            <div class="list-group-item">
                                <h4> {{$post->title}}
                                    {!!Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'style' => 'float: right'])}}
                                    {{Form::close()}}
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-default"style="float: right; margin-right: 5px;">Edit</a>
                                    <a href="/posts/{{$post->id}}" class="btn btn-primary" style="float: right; margin-right: 5px;" >Open</a>
                                </h4>
                                <small><i>{{$post->created_at}}</i><br> By <b>{{$post->name}}</b></small>
                                <br>
                            </div>
                        </div>
                    @else
                        <div class="list-group">
                            <div class="list-group-item">
                                <h4> {{$post->title}}
                                    <a href="/posts/{{$post->id}}" class="btn btn-primary" style="float: right; margin-right: 5px;" >Open</a>
                                </h4>
                                <small><i>{{$post->created_at}}</i> <br>By <b>{{$post->name}}</b></small>
                                <br>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    @else
        <div class="well">
            <h5>No posts found</h5>
        </div>
    @endif
    <div class="pages" style="align-self: center">
        {{$posts->links()}}
    </div>
    <br>
    <br>
    @else
    <h2>Posts</h2>
    <br>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="list-group">
                <div class="list-group-item">
                    <h4> {{$post->title}}
                        <a href="/posts/{{$post->id}}" class="btn btn-primary" style="float: right; margin-right: 5px;" >Open</a>
                    </h4>
                    <small>
                        <i>{{$post->created_at}}</i> 
                        <br>By 
                        <b>{{$post->name}}</b></small>
                    <br>
                </div>
            </div>
        @endforeach
    @else
        <div class="well">
            <h5>No posts found</h5>
        </div>
    @endif
    <div class="pages" style="align-self: center">
        {{$posts->links()}}
    </div>
    <br>
    <br>
    @endif
@endsection

<style>

    div.card {
        border-style: solid;
        border-color: #dfdfdf;
        border-width: 0.5px;
        border-radius: 7.5px;
        padding: 10px;
        background: #f8f8f8;
        margin: 10px;
    }

    div.card:hover{
        box-shadow: black;
    }

    div.card-body {
        width: 100%;
    }

    .flex-container {
        display: flex;
        flex-direction: row;
        font-size: 30px;
        text-align: center;
        flex-flow: wrap;
        padding: 20px;
    }

    h4.card-title {
        font-size: 20px;;
    }

    p.card-text {
        font-size: 15px;
        text-align: left;
        padding: 0;
    }

    .pages {
        text-align: center;
    }


</style>
