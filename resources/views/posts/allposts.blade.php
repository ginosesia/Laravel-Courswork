@extends('layouts.app')

@section('content')
    <h2>Posts
    <div class="float-right">
        <a href="/posts/allposts" class="btn btn-default">Search Post</a>
        <a href="/posts/create" class="btn btn-primary">New Post</a>
        <br><br>
    </div>
    </h2>
<br>
    
    @if(count($posts) > 0)
        @foreach ($posts as $post)
        <a href="/posts/{{$post->id}}">
            <div class="well">
                <h4>{{$post->title}}
                <small>Created at: {{$post->created_at}} By {{$post->name}}</small></h4>
            </div>
        </a>
        @endforeach
        {{$posts->links()}}
    @else 
    <div class="well">
        <h5>No posts found</h5>
    </div>
    @endif

@endsection
