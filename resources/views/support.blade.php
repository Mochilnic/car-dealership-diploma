@extends('layouts.user_app')

@section('title', 'Центр підтримки')

@section('content')
    <main>
        <div class="chat-container">
            <div id="chatbox">
                @foreach ($messages as $message)
                    @if ($message['role'] === 'user')
                        <div class="user-message">
                            <strong>{{ Auth::user()->name }}</strong>
                            <p> {{ $message['content'] }}</p>
                        </div>
                    @elseif($message['role'] === 'assistant')
                        <div class="assistant-message">
                            <strong>Менеджер:</strong>
                            <p> {{ $message['content'] }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            <form id="chat-form" method="POST" action="{{ route('chat.message') }}">
                @csrf
                <input required id="chat-input" autocomplete="off" type="text" name="message" id="message"
                    placeholder="Введіть повідомлення тут...">
                <button type="submit">Відправити</button>
            </form>
        </div>
    </main>

@endsection
@section('scripts')
    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatMessages = document.getElementById('chatbox');

        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const message = chatInput.value;
            chatInput.value = '';

            const userMessage = document.createElement('div');
            userMessage.classList.add('user-message', 'user');
            let username = "{{ Auth::user()->name }}";
            userMessage.innerHTML = `<strong>${username}</strong><p>${message}</p>`;
            chatMessages.appendChild(userMessage);

            fetch("{{ route('chat.message') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const assistantMessage = document.createElement('div');
                    assistantMessage.classList.add('assistant-message', 'assistant');
                    assistantMessage.innerHTML = `<strong>Менеджер:</strong><p>${data.message}</p>`;
                    chatMessages.appendChild(assistantMessage);
                });
        });
    </script>
@endsection
