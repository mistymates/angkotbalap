<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow Units') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.borrowings.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="unit_ids" :value="__('Select Units (Max 2)') " />
                            <div class="mt-2">
                                @foreach($availableUnits as $unit)
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="unit_ids[]" value="{{ $unit->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ml-2">{{ $unit->name }} ({{ $unit->code }})</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('unit_ids')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="expected_return_date" :value="__('Expected Return Date')" />
                            <x-text-input id="expected_return_date" class="block mt-1 w-full" type="date" name="expected_return_date" :value="old('expected_return_date')" required />
                            <x-input-error :messages="$errors->get('expected_return_date')" class="mt-2" />
                            <p class="text-sm text-gray-600 mt-1">Maximum borrowing period is 5 days.</p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Submit Borrowing Request') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
