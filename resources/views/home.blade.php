@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
            <div class="card">
                <h3>
                    {{ __('Dashboard') }}
                </h3>
            <hr>
            <h4>My Posts
            <div class="card-body">
                <a href="/posts/create" class="btn btn-primary">New Post</a>
            </div>
            <br>
            </h4>
            </div>
            <br>
            @if(count($posts) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>
                            <a href="/posts/{{$post->id}}" class="btn btn-primary">View</a>
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
        <br>
            <div class="back">
                <h5>You have no posts</h5>
            </div>
        @endif        
    </div>
@endsection

<style>
    div.card-body {
      float: right;
    }

    .back {
        background: #f1f1f1;
        border-width: 0.1px;
        padding: 0 10px 0 10px;
        border-style: solid;
        border-color: lightgray;
        border-radius: 5px;
        text-align: center;
    }

    </style>
