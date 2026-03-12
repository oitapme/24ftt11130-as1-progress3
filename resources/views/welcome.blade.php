@extends('layouts.blog') 
@section('content')
<main class="container mx-auto mt-6 flex gap-6">
    <!-- Blog Posts Section -->
    <section class="w-3/4">
        <!-- Main Blog Section (only show when no category filter) -->
        @if($posts->isNotEmpty() && !request('category_id'))
            @php $featured = $posts->first(); @endphp
            <div class="bg-white p-6 shadow-md rounded-lg mb-8">
                <h2 class="text-2xl font-bold mb-4">Main Blog</h2>
                <article>
                    <h3 class="text-2xl font-bold mb-3">{{ $featured->title }}</h3>
                    <img src="{{ $featured->image ? asset('images/' . $featured->image) : asset('images/placeholder-800x400.png') }}" alt="{{ $featured->title }}" class="w-1/2 object-cover rounded mb-3">
                    <p class="text-gray-600 mb-2">Published on <span class="font-semibold">{{ optional($featured->created_at)->format('F j, Y') }}</span></p>
                    <div class="text-gray-800 mb-4">
                        {!! nl2br(e($featured->content)) !!}
                    </div>
                    <a href="{{ route('posts.show', $featured->id) }}" class="text-blue-600 hover:underline">Read more</a>
                </article>
            </div>
        @endif

        <!-- Latest Posts Section -->
        <section class="bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-xl font-semibold mb-4">{{ request('category_id') ? 'Category Posts' : 'Latest Posts' }}</h2>

            <div class="space-y-6">
                @foreach ($posts->skip(request('category_id') ? 0 : 1) as $post)
                    <article class="flex gap-4 border-b pb-4">
                        <img src="{{ $post->featured_image ? asset('images/' . $post->featured_image) : asset('images/placeholder-150x150.png') }}"
                        alt="{{ $post->title }}"
                        class="w-32 h-32 object-cover rounded">
                        <div>
                            <h3 class="text-lg font-semibold"><a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a></h3>
                            <p class="text-gray-600 mb-2">{{ Str::limit($post->content, 150) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline text-sm">Read more</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </section>
<!-- Sidebar Section -->
<aside class="w-1/4 bg-white p-6 shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Categories</h2>
    <ul class="space-y-2">
        @foreach($categories as $category)
            <li>
                <a href="{{ route('home', ['category_id' => $category->id]) }}"
                   class="text-gray-600 hover:text-gray-800">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>
</main>
@endsection


