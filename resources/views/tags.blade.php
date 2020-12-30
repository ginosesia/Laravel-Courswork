@extends('layouts.app')

@section('content')

<div class="row">
     <div class="col-md-8" style="padding-right: 40px;">
          <h1>Tags</h1>
          <hr style="margin-bottom: 10px;">
          <table class="table">
               <thead>
                    <tr>
                         <th style="width: 50px;">#</th>
                         <th>Name</th>
                         <th style="width: 50px;">Post</th>
                         <th style="text-align: center; width: 100px;"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($tags as $tag)
                    <tr>
                         <td>{{$tag->id}}</td>
                         <td>{{$tag->name}}</td>
                         <td style="text-align: center;">{{$tag->post_id}}</td>
                         <td style="text-align: center;">
                              {!!Form::open(['action' => ['TagController@destroy', $tag->id], 'method' => 'POST'])!!}
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Delete', ['class' => 'remove'])}}
                              {!!Form::close()!!}                         
                         </td>
                    </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
     <div class="col-md-4" style="margin-top: 25px;">
               <div class="form-group">
                    {!! Form::open(['action' => 'TagController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <h2>Tag a Post</h2>
                    {{Form::label('name','Tag')}}
                    {{Form::text('name','',['class' => 'form-control','placeholder' => 'Add Tag'])}}
               </div>
               <div class="fom-group">
                    <?php
                    use App\Post;
                    $user = Auth::user();
                    $post = Post::all();
                    ?>
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
</div>
@endsection

<style>

.remove {
     border: none;
     background: none;
     color: red;
}

tr:hover {
     background: #f5f4f4;
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