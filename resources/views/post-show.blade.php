<x-app-layout>
    <x-slot name="metaTitle">
        {{ $metaTitle }}
    </x-slot>
    <x-slot name="metaDescription">
        {{ $metaDescription }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($post->cover_image_url)
                    <img src="{{ asset('storage/' . $post->cover_image_url) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
                @endif
                <div class="p-6 md:p-8">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 text-slate-900">{{ $post->title }}</h1>
                    <div class="text-slate-600 mb-6">
                        <span>Publicado el {{ $post->created_at->format('d F, Y') }}</span>
                    </div>
                    <div class="prose max-w-none text-slate-800">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
