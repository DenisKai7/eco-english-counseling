<x-mentor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Conversations with Users</h3>
                    @forelse($chats as $chat)
                        <div class="mb-4 p-4 border rounded-lg shadow-sm flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-lg">{{ $chat->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $chat->user->email }}</p>
                            </div>
                            <a href="{{ route('mentor.chats.show', $chat->user) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">View Chat</a>
                        </div>
                    @empty
                        <p class="text-gray-600">You don't have any active chats yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-mentor-layout>