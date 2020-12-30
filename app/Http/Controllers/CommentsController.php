<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use App\Notifications\CommentCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'comment' => 'required|min:2|max:2000',
            'email' => 'required',
            'name' => 'required'
        ));

        $post = Post::find($post_id);
        $user = Auth::user();

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post_id = $post->id;
        $comment->user_id = $user->id;
        $comment->post()->associate($post);
        $comment->save();

        User::find($post->user_id)->notify(new CommentCreated($user, $post, $comment));
        return redirect()->back()->with('success','Comment Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if(auth()->user()->id == $comment->user_id || auth()->user()->role == 'Admin') {
            $comment->delete();
            return redirect()->back()->with('success','Comment Removed');
        }
        
        return redirect('/posts')->with('error','Unauthorised Page');

    }
}
