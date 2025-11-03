<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-4">
                        <strong>Role:</strong> {{ $user->role }}
                    </div>
                    <div class="mb-4">
                        <strong>Profile:</strong>
                        @if($user->profile)
                            <p>Phone: {{ $user->profile->phone }}</p>
                            <p>Address: {{ $user->profile->address }}</p>
                            <p>Birth Date: {{ $user->profile->birth_date }}</p>
                        @else
                            No profile set.
                        @endif
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
