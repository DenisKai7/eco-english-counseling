<x-mentor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Welcome,
                        @if (Auth::guard('web')->check() && Auth::user()->role === 'mentor')
                            {{ Auth::user()->name }}
                        @elseif (Auth::guard('mentor')->check())
                            {{ Auth::guard('mentor')->user()->name }}
                        @else
                            Mentor!
                        @endif
                        !
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-blue-800">Total Materials Created</h4>
                            <p class="text-3xl font-bold text-blue-900">{{ $totalMaterials }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-green-800">Recent Chats</h4>
                            <ul class="list-disc list-inside mt-2">
                                @forelse($recentChats as $chat)
                                    <li><a href="{{ route('mentor.chats.show', $chat->user) }}" class="text-green-700 hover:underline">Chat with {{ $chat->user->name ?? 'Unknown User' }}: "{{ Str::limit($chat->message, 30) }}"</a></li>
                                @empty
                                    <li>No recent chats.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    {{-- Bagian Baru: Forms to Review --}}
                    <div class="mt-8">
                        <h4 class="font-semibold text-purple-800">Forms to Review</h4>
                        @if($formsToReview->isEmpty())
                            <p class="text-gray-600 mt-2">No forms currently awaiting your review.</p>
                        @else
                            <ul class="list-disc list-inside mt-2 space-y-2">
                                @foreach($formsToReview as $form)
                                    <li class="bg-gray-50 p-3 rounded-md shadow-sm flex justify-between items-center">
                                        <span>
                                            Form {{ ucfirst(str_replace('_', ' ', $form->form_type)) }} from
                                            <strong>
                                                @if ($form->form_type === 'teacher_mentor')
                                                    {{ $form->mentor->name ?? 'Unknown Mentor' }} {{-- Ambil nama dari relasi mentor --}}
                                                @else
                                                    {{ $form->user->name ?? 'Unknown User' }} {{-- Ambil nama dari relasi user --}}
                                                @endif
                                            </strong>
                                            on {{ $form->created_at->format('d M Y') }}
                                        </span>
                                        <a href="{{ route('mentor.development.review', $form) }}" class="px-3 py-1 bg-purple-600 text-white rounded-md text-sm hover:bg-purple-700">Review</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-4">
                                {{ $formsToReview->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-mentor-layout>