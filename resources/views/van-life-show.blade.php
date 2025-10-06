<x-app-layout>
    <x-slot name="metaTitle">
        {{ $metaTitle }}
    </x-slot>
    <x-slot name="metaDescription">
        {{ $metaDescription }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <img src="{{ asset('storage/' . $post->cover_image_url) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
                    <div class="text-gray-600 mb-4">
                        <span>Published on {{ $post->created_at->format('F d, Y') }} in </span>
                        <a href="#" class="text-blue-500">{{ $post->category->name }}</a>
                    </div>
                    <div class="prose max-w-none">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
