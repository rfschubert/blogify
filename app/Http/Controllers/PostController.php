<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\ExternalPostImporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:draft,published',
        ]);

        Post::create($request->only(['title', 'content', 'status']));

        return Redirect::route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:draft,published',
        ]);

        $post->update($request->only(['title', 'content', 'status']));

        return Redirect::route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return Redirect::route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function importForm()
    {
        $providers = ExternalPostImporter::getProviders();
        return view('posts.import', compact('providers'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'provider' => 'required|string',
            'id' => 'required|integer',
        ]);

        try {
            $post = ExternalPostImporter::load($request->provider)->import($request->id);
            return Redirect::route('posts.index')->with('success', 'Post imported successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
