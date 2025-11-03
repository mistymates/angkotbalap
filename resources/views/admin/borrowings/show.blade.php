<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowing Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>User:</strong> {{ $borrowing->user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Unit:</strong> {{ $borrowing->unit->name }} ({{ $borrowing->unit->code }})
                    </div>
                    <div class="mb-4">
                        <strong>Borrow Date:</strong> {{ $borrowing->borrow_date->format('Y-m-d H:i') }}
                    </div>
                    <div class="mb-4">
                        <strong>Expected Return Date:</strong> {{ $borrowing->expected_return_date->format('Y-m-d') }}
                    </div>
                    <div class="mb-4">
                        <strong>Actual Return Date:</strong> {{ $borrowing->actual_return_date ? $borrowing->actual_return_date->format('Y-m-d H:i') : 'Not returned' }}
                    </div>
                    <div class="mb-4">
                        <strong>Status:</strong> {{ $borrowing->status }}
                    </div>
                    <div class="mb-4">
                        <strong>Fine Amount:</strong> {{ $borrowing->fine_amount ? 'Rp ' . number_format($borrowing->fine_amount, 0, ',', '.') : 'None' }}
                    </div>
                    <div class="mb-4">
                        <strong>History:</strong>
                        @if($borrowing->histories->count() > 0)
                            <ul>
                                @foreach($borrowing->histories as $history)
                                    <li>{{ $history->action }} - {{ $history->date->format('Y-m-d H:i') }} - {{ $history->notes }}</li>
                                @endforeach
                            </ul>
                        @else
                            No history.
                        @endif
                    </div>
                    <a href="{{ route('admin.borrowings.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to Borrowings
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
