@extends('layouts.blog')
 
@section('content')
<main class="container mx-auto mt-6 flex justify-center">
    <!-- Blog Article Section -->
    <section class="w-3/5 bg-white p-6 shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <img src="{{ $post->image 
        ? asset('images/' . $post->image) 
        : asset('images/placeholder-800x400.png') }}" alt="{{ $post->title }}" class="w-full object-cover rounded mb-4">
        <p class="text-gray-600 mb-4">Published on <span class="font-semibold">March 2, 2025</span></p>
        <div class="text-gray-800 space-y-4">

            <p>{{ $post->content_post }}</p>

        </div>
        <div class="flex justify-between mt-6">
            <button onclick="history.back()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Back</button>

            @if(isset($next) && $next)
                <a href="{{ route('posts.show', $next) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Next</a>
            @else
                <button disabled class="px-4 py-2 bg-gray-100 text-gray-400 rounded" aria-disabled="true">Next</button>
            @endif
        </div>
    </section>
</main>
@endsection