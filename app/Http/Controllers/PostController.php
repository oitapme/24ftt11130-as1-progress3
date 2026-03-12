<?php

namespace App\Http\Controllers;
 
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
 
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->get();
 
        return view('posts.index', compact('posts'));
    }
 
    public function create()
    {
        $categories = Category::all();
 
        return view('posts.create', compact('categories'));
    }
 
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        // ensure content_post is present even if empty
        $data['content_post'] = $request->input('content_post');
        Post::create($data);
 
        return redirect()->route('posts.index');
    }
 
    public function show(Post $post)
    {
        // load next post for navigation
        $next = Post::where('id', '>', $post->id)->orderBy('id')->first();

        return view('post', compact('post', 'next'));
    }
 
    public function edit(Post $post)
    {
        $categories = Category::all();
 
        return view('posts.edit', compact('post', 'categories'));
    }
 
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'content_post' => $request->input('content_post'),
            'category_id' => $request->input('category_id'),
        ]);
 
        return redirect()->route('posts.index');
    }
 
    public function destroy(Post $post)
    {
        $post->delete();
 
        return redirect()->route('posts.index');
    }
}
