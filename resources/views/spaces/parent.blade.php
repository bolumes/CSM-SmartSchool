<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_chat.css') }}">
    <link rel="icon" href="{{ asset('img/books.png') }}">
</head>
<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebargestchat')

<!-- ================= CHAT PARENT ================= -->
@php
    $spaceType = 'parent';
    $fieldsetClass = 'chat-fieldset chat-fieldset-' . $spaceType;
    $containerClass = 'chat-container chat-container-' . $spaceType;
@endphp

<div class="main-content chat-page">

    <fieldset class="{{ $fieldsetClass }}">
        <legend><h3>CHAT PARENTS</h3></legend>

        <div class="chat-wrapper">
            <div class="{{ $containerClass }}">

                <div class="chat-header">
                    <h3>{{ $space->name }}</h3>
                    <p>{{ $space->description }}</p>
                </div>

                <div class="chat-messages" id="chatMessages">
                    @foreach($space->posts as $post)
                    @php $isMine = $post->user_id === auth()->id(); @endphp

                    <div class="chat-post {{ $isMine ? 'mine' : 'other' }}" data-post-id="{{ $post->id }}">
                        <div class="content">
                            <p>{{ $post->content }}</p>

                            @if($post->attachments && $post->attachments->count())
                                <div class="chat-attachments">
                                    @foreach($post->attachments as $file)

                                        @if(str_starts_with($file->file_type, 'image'))
                                            <img src="{{ asset('storage/' . $file->file_path) }}"
                                                style="max-width:200px; display:block; margin-top:5px;">
                                        @else
                                            <div>
                                                <a href="{{ asset('storage/' . $file->file_path) }}"
                                                target="_blank">
                                                    📎 {{ $file->file_name }}
                                                </a>
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            @endif

                            <span class="meta">
                                {{ $isMine ? 'Você' : ($post->user->email ?? 'Utilizador') }}
                                | {{ $post->created_at->diffForHumans() }}
                            </span>

                            @foreach($post->comments as $comment)
                            @php $isCommentMine = $comment->user_id === auth()->id(); @endphp
                            <div class="chat-comment {{ $isCommentMine ? 'mine' : 'other' }}">
                                <div class="content">
                                    <p>{{ $comment->content }}</p>
                                    <span class="meta">
                                        {{ $isCommentMine ? 'Você' : ($comment->user->email ?? 'Utilizador') }}
                                        | {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endforeach

                </div>

                <form action="{{ route('spaces.message.store', $space->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="chat-form">
                    @csrf

                    <div class="input-wrapper">

                        <label for="fileUpload" class="file-button">
                            <i class="fas fa-paperclip"></i>
                        </label>
                        <input type="file"
                            id="fileUpload"
                            name="attachments[]"
                            multiple
                            hidden>

                        <input type="text"
                            name="content"
                            placeholder="Escreva sua mensagem..."
                            class="chat-input">

                        <button type="submit" class="send-button">
                            <i class="fas fa-paper-plane"></i>
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </fieldset>
</div>

<!-- O mesmo script do chat professor -->
<script>
function toggleMenu() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    sidebar.classList.toggle("open");
    overlay.classList.toggle("active");
}

function toggleSubmenu(element) {
    element.classList.toggle("open");
}

const chatMessages = document.getElementById('chatMessages');
if(chatMessages){
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

document.addEventListener('DOMContentLoaded', function() {
    let currentPostId = null;

    document.querySelectorAll('.chat-post').forEach(function(post){
        post.addEventListener('contextmenu', function(e){
            e.preventDefault();
            currentPostId = this.dataset.postId;
            if (this.querySelector('.comment-input')) return;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ url('/posts') }}/" + currentPostId + "/comment";

            const token = document.createElement('input');
            token.type = 'hidden';
            token.name = '_token';
            token.value = "{{ csrf_token() }}";

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'content';
            input.classList.add('comment-input');
            input.placeholder = 'Escreva seu comentário...';
            input.required = true;

            form.appendChild(token);
            form.appendChild(input);
            this.querySelector('.content').appendChild(form);
            input.focus();

            input.addEventListener('keydown', function(e){
                if(e.key === 'Enter'){
                    e.preventDefault();
                    form.submit();
                }
            });
        });
    });
});
</script>

</body>
</html>