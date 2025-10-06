<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="{{ route('posts.show', $post) }}">
                            <img src="{{ asset('storage/' . $post->cover_image_url) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-500">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ $post->created_at->format('F d, Y') }}
                            </p>
                            <p class="text-gray-700">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 col-span-full">Aún no hay posts en esta sección.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
