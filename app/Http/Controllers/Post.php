<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Post extends Controller
{
    // posts.index
    public function index()
    {
        // implement posts.blade.php view rendering
        return view('posts');
    }
}