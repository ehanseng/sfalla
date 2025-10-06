<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page Banner Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($banner->image_url)
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Current Image:</p>
                            <img src="{{ asset('storage/' . $banner->image_url) }}" alt="Current Hero Image" class="mt-2 h-40 w-auto rounded-md">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.hero-banner.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hero Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <!-- Hero Subtitle -->
                        <div class="mb-4">
                            <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <!-- Hero Image -->
                        <div class="mb-4">
                            <label for="hero_image" class="block text-sm font-medium text-gray-700">Background Image</label>
                            <input type="file" name="hero_image" id="hero_image" class="mt-1 block w-full">
                        </div>

                        <!-- Hero Height -->
                        <div class="mb-4">
                            <label for="height" class="block text-sm font-medium text-gray-700">Banner Height (%)</label>
                            <input type="number" name="height" id="height" value="{{ old('height', $banner->height ?? 80) }}" min="10" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <p class="mt-2 text-sm text-gray-500">Enter a value between 10 and 100. This is the percentage of the screen height.</p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
