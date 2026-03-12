<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of image records attached to posts.
     */
    public function index()
    {
        $posts = Post::orderBy('id')->get();

        return view('images.index', compact('posts'));
    }

    /**
     * Show the form for assigning images to a post.
     */
    public function create()
    {
        $posts = Post::orderBy('title')->get();

        return view('images.create', compact('posts'));
    }

    /**
     * Store newly assigned image paths for a post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => ['required', 'exists:posts,id'],
            'image' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'string', 'max:255'],
        ]);

        $post = Post::findOrFail($validated['post_id']);
        $post->update([
            'image' => $validated['image'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
        ]);

        return redirect()->route('images.index');
    }

    /**
     * Show the form for editing image paths of the specified post.
     */
    public function edit(Post $image)
    {
        return view('images.edit', ['post' => $image]);
    }

    /**
     * Update image paths for the specified post.
     */
    public function update(Request $request, Post $image)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'string', 'max:255'],
        ]);

        $image->update([
            'image' => $validated['image'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
        ]);

        return redirect()->route('images.index');
    }

    /**
     * Clear image paths from the specified post.
     */
    public function destroy(Post $image)
    {
        $image->update([
            'image' => null,
            'featured_image' => null,
        ]);

        return redirect()->route('images.index');
    }
}
