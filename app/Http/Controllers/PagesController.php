<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome to InstaChat';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title',$title);
    }

    public function about() {
        $data = array(
            'title' => 'About',
        );
        return view('pages.about')->with($data);
    }

    public function profile() {
        return view('pages.profile');
    }

    public function posts() {
        return view('pages.posts');
    }
}