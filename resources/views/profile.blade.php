@extends('layouts.app')

@section('content')

<div class="profile">
    <div class="container-fluid">
        <div class="row">
            <h2>Profile</h2>
        </div>
    </div>
    <div class="container-fluid">
        <div class="comment-form">
            <?php
                use App\Post;
                use App\Comment;
                $user = Auth::user();
                $name = $user->name;
                $email = $user->email;
                $role = $user->role; 
                $id = $user->id;
                $post = Post::all();
                $comment = Comment::all();
            ?>
            <div class="row">
                <div class="col-md-3">
                    <img src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($email)))."?s=50&d=wavatar"}}" class="profile-img">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-2">
                            {{Form::label('name', 'Name:')}}
                        </div>
                        <div class="col-md-4">
                            {{Form::text('name', $name, ['class' => 'form-control', 'style' => 'margin-bottom: 5px; background: none;', 'readonly'])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {{Form::label('email', 'Email:')}}
                        </div>
                        <div class="col-md-4">
                            {{Form::text('email', $email, ['class' => 'form-control', 'style' => 'margin-bottom: 5px; background: none;', 'readonly'])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {{Form::label('role', 'Role:')}}
                        </div>
                        <div class="col-md-4">
                            {{Form::text('role', $role, ['class' => 'form-control', 'style' => 'margin-bottom: 5px; background: none;', 'readonly'])}}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <h2>Posts</h2>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                {{Form::label('post', 'Posts:')}}
                            </div>
                            <div class="col-md-10">
                                <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                        @foreach($post as $posts)
                                            @if($posts->user_id == Auth::user()->id)
                                                <option value="/posts/{{$posts->id}}" selected>
                                                    {{$posts->title}}
                                                </option>
                                            @endif 
                                        @endforeach
                                    <option disabled selected>Select Post</option>        
                                </select> 
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <h2>Comments</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            {{Form::label('comment', 'Comments:')}}
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                @foreach($comment as $comments)
                                    @if($comments->user_id == Auth::user()->id)
                                        <option value="/posts/{{$comments->post_id}}" selected>
                                            {{$comments->comment}}
                                        </option>        
                                    @endif       
                                @endforeach
                                <option disabled selected>Select Comment</option> 
                            </select>  
                        </div>
                    </div>        
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
<br>
@endsection

<style>
.profile {
    margin:0;
    border-radius: 12px;
    border-style: solid;
    border-width: 1px;
    border-color: #f1f1f1;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding-left: 35px;
    padding-right: 35px;
}

.image {
    height: 90px;
    margin: 0;
}

.profile-img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  float: left;
}

.row {
    margin-top: 20px;
}

</style>
