<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $unit->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Code:</strong> {{ $unit->code }}
                    </div>
                    <div class="mb-4">
                        <strong>Description:</strong> {{ $unit->description }}
                    </div>
                    <div class="mb-4">
                        <strong>Categories:</strong>
                        @if($unit->categories->count() > 0)
                            <ul>
                                @foreach($unit->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            No categories assigned.
                        @endif
                    </div>
                    <a href="{{ route('user.units.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to Units
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
