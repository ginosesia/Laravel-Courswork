@extends('layouts.app')
@section('content')
<?php
     use App\Tag;
     use App\Post;

     $alltags = Tag::all();

     $tagName = $tag->name;

     $numberofposts = $tag->where('name',$tagName)->count();
?>


     <div class="row">
          <div class="col-md-10">
               <h2>{{$tag->name }} 
                    @if($numberofposts == 1)
                    <br><small>{{$numberofposts}} Post</small></h2>
                    @else
                    <br><small>{{$numberofposts}} Posts</small></h2>
                    @endif
               </div>   
          <div class="col-md-2">
               <a href="/tags" class="btn btn-default pull-right" style="margin-top: 20px;">Back</a>
          </div>
     </div>     
     <hr>
     <div class="row">
          <div class="col-md-12">
               <table class="table">
                    <thead>
                         <tr>
                              <th>Post Title</th>
                              <th>Author</th>
                              <th>Created at</th>
                              <th style="width: 40px;"></th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         $post = Post::all();
                         $alltags = Tag::all();
                         ?>
                         @foreach($alltags as $tags)
                         <?php
                         $id = $tags->post_id;
                         $tag1 = $tags->name;
                         $tag2 = $tag->name;
                         ?>
                         @if($tag1 == $tag2)
                              @foreach($post as $posts)
                                   @if($posts->id == $id)
                                        <tr>
                                             <td>{{$posts->title}}</td>
                                             <td>{{$posts->name}}</td>
                                             <td>{{$posts->created_at}}</td>
                                             <td><a href="/posts/{{$id}}" class="btn btn-default btn-xs">View</a></td>
                                        </tr>
                                   @endif
                              @endforeach
                         @endif
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
@endsection