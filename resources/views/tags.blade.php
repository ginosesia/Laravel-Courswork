@extends('layouts.app')

@section('content')
<?php
     use App\Post;
     $user = Auth::user();
     $post = Post::all();
     $numberofposts = $post->where('user_id',$user->id)->count();
?>


<div class="row">
     <div class="col-md-8" style="padding-right: 40px;">
          <h1>Tags</h1>
          <hr style="margin-bottom: 10px;">
          <table class="table">
               <thead>
                    <tr> 
                         <th>Tag</th>
                         <th style="width: 150px;">Associated Posts</th>
                         <th style="text-align: center; width: 100px;"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($tags as $tag)
                         @if($tag->user_id == $user->id)
                              <tr>
                                   <td><a href="/posts/{{$tag->post_id}}" >{{$tag->name}}</a></td>
                                   <td style="text-align: center;"><a href="/tags/{{$tag->id}}" class="btn btn-default btn-xs">View</a></td>                                   
                                   <td style="text-align: center;">
                                        {!!Form::open(['action' => ['TagController@destroy', $tag->id], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])}}
                                        {!!Form::close()!!}                         
                                   </td>
                              </tr>
                         @endif
                    @endforeach
               </tbody>
          </table>
          <div class="pages" style="align-self: center">
               {{$tags->links()}}
           </div>
     </div>
     @if($numberofposts != 0)
          <div class="col-md-4" style="margin-top: 25px;">
               <div class="form-group">
                    {!! Form::open(['action' => 'TagController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <h2>Tag a Post</h2>
                    {{Form::label('name','Tag')}}
                    {{Form::text('name','',['class' => 'form-control','placeholder' => 'Add Tag'])}}
               </div>
               <div class="fom-group">
                    <label for="post" c>{{ __('Post') }}</label>
                    <select class="form-control" id="post" name="post" required focus>

                    @foreach($post as $posts)
                         @if($posts->user_id == Auth::user()->id)
                              <option value="{{$posts->id}}" selected>
                                   {{$posts->title}}
                              </option>
                         @endif 
                    @endforeach
                    <option disabled selected>Select Post</option>  
               </div>
               <div class="form-group">
                    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'style' => 'margin-top: 20px; margin-bottom: 20px;'])}}
                    {!! Form::close() !!}
               </div>
          </div>
     @else
          <div class="col-md-4" style="margin-top: 25px;">
               <div class="form-group">
                    {!! Form::open(['action' => 'TagController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <h2>Tag a Post</h2>
                    {{Form::label('name','Tag')}}
                    {{Form::text('name','',['class' => 'form-control','placeholder' => 'Add Tag', 'readonly'])}}
               </div>
               <div class="fom-group">
                    <label for="post" c>{{ __('Post') }}</label>
                    <select class="form-control" id="post" name="post" disabled>
                         @foreach($post as $posts)
                              @if($posts->user_id == Auth::user()->id)
                                   <option value="{{$posts->id}}" selected>
                                        {{$posts->title}}
                                   </option>
                              @endif 
                         @endforeach
                    <option disabled selected>Select Post</option>  
               </div>
               <div class="form-group">
                    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'style' => 'margin-top: 20px; margin-bottom: 20px;', 'disabled'])}}
                    {!! Form::close() !!}
               </div>
               <div class="form-group">
                    <a href="posts/create"> Create a post to tag </a>
               </div>
          </div>
     @endif
</div>
@endsection

<style>

.remove {
     border: none;
     background: none;
     color: red;
}



div.col-md-4 {
     background: #f1f1f1;
     border-radius: 5px;
     padding: 15px 25px 15px 25px;
     border-width: 0.1px;
     border-style: solid;
     border-color: lightgray;
}

</style>