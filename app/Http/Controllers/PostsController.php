<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use App\User;
use App\Tag;




class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images',$filenameToStore);
        } else {
            $filenameToStore = 'noImage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->name = $user->name;
        $post->email = $user->email;
        $post->user_id = auth()->user()->id;
        $post->image = $filenameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::all();
        $post = Post::find($id);
        return view('posts.show')->with('post',$post)->with('comments',$comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //check for correct user
        if(auth()->user()->id == $post->user_id || auth()->user()->role == 'Admin') {
            return view('posts.edit')->with('post',$post);
        } else {
        return redirect('/posts')->with('error','Unauthorised Page');
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'name' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images',$filenameToStore);
        } else {
            $filenameToStore = 'noImage.jpg';
        }
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->name = $request->input('name');
        $post->user_id = $post->user_id;
        $post->image = $filenameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $tag = Tag::find($id);
        $tag->delete();

        if(auth()->user()->id == $post->user_id || auth()->user()->role == 'Admin') {
            $post->delete();
            return redirect('/posts')->with('success','Post Removed');
        }
        return redirect('/posts')->with('error','Unauthorised Page');

    }
}
