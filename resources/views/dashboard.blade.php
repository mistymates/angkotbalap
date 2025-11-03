<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    @if(auth()->user()->isAdmin())
                        <h3 class="text-lg font-medium mb-4">Admin Dashboard</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('admin.users.index') }}" class="block p-4 bg-blue-500 text-white rounded hover:bg-blue-600">Manage Users</a>
                            <a href="{{ route('admin.categories.index') }}" class="block p-4 bg-green-500 text-white rounded hover:bg-green-600">Manage Categories</a>
                            <a href="{{ route('admin.units.index') }}" class="block p-4 bg-yellow-500 text-white rounded hover:bg-yellow-600">Manage Units</a>
                            <a href="{{ route('admin.borrowings.index') }}" class="block p-4 bg-red-500 text-white rounded hover:bg-red-600">Manage Borrowings</a>
                            <a href="{{ route('admin.histories.index') }}" class="block p-4 bg-purple-500 text-white rounded hover:bg-purple-600">View Histories</a>
                        </div>
                    @else
                        <h3 class="text-lg font-medium mb-4">User Dashboard</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="{{ route('user.units.index') }}" class="block p-4 bg-blue-500 text-white rounded hover:bg-blue-600">Browse Units</a>
                            <a href="{{ route('user.borrowings.index') }}" class="block p-4 bg-green-500 text-white rounded hover:bg-green-600">My Borrowings</a>
                            <a href="{{ route('user.borrowings.create') }}" class="block p-4 bg-yellow-500 text-white rounded hover:bg-yellow-600">Borrow Unit</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
