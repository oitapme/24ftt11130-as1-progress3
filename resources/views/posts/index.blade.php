<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Actions Section -->
                <div class="p-6 border-b border-gray-200">
                    <a href="{{ route('posts.create') }}" 
                       style="display: inline-block; padding: 8px 16px; background-color: #6b7280; color: white; text-decoration: none; border-radius: 4px;">
                        Add new post
                    </a>
                </div>

                <!-- Posts List Section -->
                <div class="p-6 bg-white">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="border: 1px solid #e5e7eb; padding: 12px; text-align: left;">Title</th>
                                <th style="border: 1px solid #e5e7eb; padding: 12px; text-align: left;">Category</th>
                                <th style="border: 1px solid #e5e7eb; padding: 12px; text-align: left;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">{{ $post->title }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">{{ $post->category->name }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">
                                        <a href="{{ route('posts.edit', $post) }}" 
                                           style="display: inline-block; padding: 6px 12px; background-color: #6b7280; color: white; text-decoration: none; border-radius: 4px; margin-right: 8px;">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" 
                                                    style="padding: 6px 12px; background-color: #6b7280; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>