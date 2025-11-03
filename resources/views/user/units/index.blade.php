<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Units') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('user.units.index') }}" class="mb-6">
                        <div class="flex">
                            <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" :value="request('search')" placeholder="Search by unit name..." />
                            <x-primary-button class="ml-2">
                                Search
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($units as $unit)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium">{{ $unit->name }}</h3>
                            <p class="text-sm text-gray-600">Code: {{ $unit->code }}</p>
                            <p class="text-sm text-gray-600">{{ $unit->description }}</p>
                            <p class="text-sm text-gray-600">Categories: @foreach($unit->categories as $category) {{ $category->name }}@if(!$loop->last), @endif @endforeach</p>
                            <a href="{{ route('user.units.show', $unit) }}" class="mt-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">
                                View Details
                            </a>
                        </div>
                        @endforeach
                    </div>

                    {{ $units->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
