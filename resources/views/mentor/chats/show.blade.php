<x-mentor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat with') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col h-[500px] border rounded-lg overflow-y-auto p-4 mb-4" id="chat-messages">
                        @foreach($messages as $message)
                            <div class="mb-2 {{ $message->sender_type == 'mentor' ? 'self-end bg-blue-100' : 'self-start bg-gray-100' }} p-2 rounded-lg max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <span class="text-xs text-gray-500">{{ $message->created_at->format('H:i') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <form id="chat-form" class="flex">
                        @csrf
                        <input type="text" name="message" id="chat-input" class="flex-grow border rounded-lg p-2 mr-2" placeholder="Type your message..." required>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', function () {
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        const chatForm = document.getElementById('chat-form');

        // Scroll to bottom on load
        chatMessages.scrollTop = chatMessages.scrollHeight;

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = chatInput.value;
            if (message.trim() === '') return;

            axios.post('{{ route('mentor.chats.sendMessage', $user) }}', { message: message })
                .then(response => {
                    chatInput.value = '';
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                });
        });

        // Listen for new messages
        // Perhatikan channel name harus sesuai dengan yang di Event
        window.Echo.private('chat.{{ $user->id }}.{{ Auth::guard('mentor')->id() }}')
            .listen('.message-sent', (e) => {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('mb-2', 'p-2', 'rounded-lg', 'max-w-xs');

                // Determine if the message is from current mentor or user
                const isCurrentMentor = e.senderType === 'mentor'; // Asumsi mentor adalah pengirim di frontend ini
                messageDiv.classList.add(isCurrentMentor ? 'self-end', 'bg-blue-100' : 'self-start', 'bg-gray-100');

                messageDiv.innerHTML = `
                    <p class="text-sm">${e.message}</p>
                    <span class="text-xs text-gray-500">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                `;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to bottom
            });
    });
</script>
@endpush
</x-mentor-layout>