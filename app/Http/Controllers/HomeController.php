<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->take(5)->get();
        return view('welcome', compact('posts'));
    }
}
