<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Biografía Interactiva') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ selectedCategory: 'all' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Botones de Filtro -->
            <div class="flex justify-center space-x-4 mb-8">
                <button @click="selectedCategory = 'all'"
                        :class="{ 'bg-blue-500 text-white': selectedCategory === 'all', 'bg-white text-gray-700': selectedCategory !== 'all' }"
                        class="px-4 py-2 rounded-md shadow-sm font-medium">
                    Todos
                </button>
                @foreach ($categories as $category)
                    <button @click="selectedCategory = {{ $category->id }}"
                            :class="{ 'bg-blue-500 text-white': selectedCategory === {{ $category->id }}, 'bg-white text-gray-700': selectedCategory !== {{ $category->id }} }"
                            class="px-4 py-2 rounded-md shadow-sm font-medium">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Línea de Tiempo -->
            <div class="relative">
                <!-- Línea vertical central -->
                <div class="border-r-2 border-gray-300 absolute h-full top-0" style="left: 50%"></div>

                @foreach ($events as $index => $event)
                    <div class="mb-8 flex justify-between items-center w-full"
                         x-show="selectedCategory === 'all' || selectedCategory === {{ $event->category_id }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-90">

                        <!-- Contenido Izquierda/Derecha -->
                        @if($index % 2 == 0)
                            <!-- Contenido a la izquierda -->
                            <div class="w-1/2 pr-8">
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <img src="{{ asset('storage/' . $event->cover_image_url) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                                    <span class="text-sm text-gray-500">{{ $event->event_date->format('F Y') }}</span>
                                    <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                                    <p class="text-gray-700">{{ $event->description }}</p>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mt-4">{{ $event->category->name }}</span>
                                </div>
                            </div>
                            <div class="w-1/2"></div>
                        @else
                            <!-- Contenido a la derecha -->
                            <div class="w-1/2"></div>
                            <div class="w-1/2 pl-8">
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <img src="{{ asset('storage/' . $event->cover_image_url) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                                    <span class="text-sm text-gray-500">{{ $event->event_date->format('F Y') }}</span>
                                    <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                                    <p class="text-gray-700">{{ $event->description }}</p>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mt-4">{{ $event->category->name }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Círculo en la línea -->
                        <div class="rounded-full bg-blue-500 border-4 border-white w-8 h-8 absolute top-1/2 -translate-y-1/2" style="left: 50%; transform: translateX(-50%);"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
