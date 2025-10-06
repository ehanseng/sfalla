<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $banner->title ?? 'Santiago Falla' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-slate-900 text-white flex items-center justify-center text-center overflow-hidden" 
         style="height: {{ $banner->height ?? 80 }}vh;">
        @if($banner && $banner->image_url)
            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $banner->image_url) }}" alt="Background" class="w-full h-full object-cover opacity-30">
            </div>
        @endif
        <div class="relative z-10 p-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight">{{ $banner->title ?? 'Santiago Falla' }}</h1>
            <p class="mt-6 text-lg md:text-xl leading-8 max-w-2xl mx-auto">{{ $banner->subtitle ?? 'Un recorrido a través de mi carrera y mis pasiones.' }}</p>
        </div>
        <!-- Scroll Down Arrow -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10">
            <a href="#timeline" class="animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
        </div>
    </div>

    <div class="py-12" x-data="{ selectedCategory: 'all', openEventId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="text-center mb-16">
                <div class="flex justify-center flex-wrap gap-4">
                    <button @click="selectedCategory = 'all'; openEventId = null"
                            :class="{ 'bg-slate-900 text-white': selectedCategory === 'all', 'bg-white text-slate-700 border border-slate-200': selectedCategory !== 'all' }"
                            class="px-4 py-2 rounded-md shadow-sm font-medium transition-colors">
                        Todos
                    </button>
                    @foreach ($categories as $category)
                        <button @click="selectedCategory = {{ $category->id }}; openEventId = null"
                                :class="{ 'bg-slate-900 text-white': selectedCategory === {{ $category->id }}, 'bg-white text-slate-700 border border-slate-200': selectedCategory !== {{ $category->id }} }"
                                class="px-4 py-2 rounded-md shadow-sm font-medium transition-colors">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Línea de Tiempo -->
            <div class="relative">
                <!-- Línea vertical central -->
                <div class="border-r-2 border-slate-200 absolute h-full top-0" style="left: 50%"></div>

                @forelse ($events as $index => $event)
                    <div class="mb-8 flex justify-between items-center w-full relative"
                         x-show="selectedCategory === 'all' || selectedCategory === {{ $event->category_id }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100">

                        <!-- Contenido Izquierda/Derecha -->
                        @if($index % 2 == 0)
                            <div class="w-1/2 pr-8">
                                <div @click="openEventId = (openEventId === {{ $event->id }} ? null : {{ $event->id }})" class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm hover:shadow-lg transition-all cursor-pointer">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $event->cover_image_url) }}" alt="{{ $event->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
                                        <div>
                                            <span class="text-sm text-slate-500">{{ $event->event_date->format('F Y') }}</span>
                                            <h3 class="text-lg font-bold text-slate-900">{{ $event->title }}</h3>
                                        </div>
                                    </div>
                                    <div x-show="openEventId === {{ $event->id }}" x-collapse class="mt-4 pt-4 border-t border-slate-200">
                                        <p class="text-slate-700">{{ $event->description }}</p>
                                        <span class="inline-block bg-slate-100 rounded-full px-3 py-1 text-sm font-semibold text-slate-600 mt-4">{{ $event->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2"></div>
                        @else
                            <div class="w-1/2"></div>
                            <div class="w-1/2 pl-8">
                                <div @click="openEventId = (openEventId === {{ $event->id }} ? null : {{ $event->id }})" class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm hover:shadow-lg transition-all cursor-pointer">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $event->cover_image_url) }}" alt="{{ $event->title }}" class="w-24 h-24 object-cover rounded-md mr-4">
                                        <div>
                                            <span class="text-sm text-slate-500">{{ $event->event_date->format('F Y') }}</span>
                                            <h3 class="text-lg font-bold text-slate-900">{{ $event->title }}</h3>
                                        </div>
                                    </div>
                                    <div x-show="openEventId === {{ $event->id }}" x-collapse class="mt-4 pt-4 border-t border-slate-200">
                                        <p class="text-slate-700">{{ $event->description }}</p>
                                        <span class="inline-block bg-slate-100 rounded-full px-3 py-1 text-sm font-semibold text-slate-600 mt-4">{{ $event->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Círculo en la línea -->
                        <div class="absolute top-1/2 -translate-y-1/2 flex items-center z-10" style="left: 50%; transform: translateX(-50%);">
                            <div class="flex items-center justify-center rounded-full bg-slate-900 text-white font-bold text-sm border-4 border-white p-1.5 aspect-square">
                                {{ $event->event_date->format('d') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-500">
                        <p>Aún no hay eventos en la línea de tiempo. ¡Añade el primero desde el panel de administración!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
</body>
</html>
