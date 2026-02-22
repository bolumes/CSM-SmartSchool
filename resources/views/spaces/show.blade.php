<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_chat.css">
    <link rel="icon" href="../../img/books.png">
</head>

<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo">
        <img src="../../img/logo.png" alt="Logo">
    </div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebarwelcome')

<!-- ================= CHAT PAGE ================= -->
<div class="main-content chat-page">

    <fieldset class="chat-fieldset">
        <legend><h3>CHAT PROFESSEURS</h3></legend>

        <div class="chat-wrapper">
            <div class="chat-container">

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

                <form action="{{ route('spaces.message.store', $space->id) }}" method="POST" class="chat-form">
                    @csrf
                    <input type="text" name="content" placeholder="Escreva sua mensagem..." required>
                    <button type="submit">Enviar</button>
                </form>

            </div>
        </div>
    </fieldset>
</div>


<script>
// ================= SIDEBAR =================
function toggleMenu() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    sidebar.classList.toggle("open");
    overlay.classList.toggle("active");
}

function toggleSubmenu(element) {
    element.classList.toggle("open");
}

// Auto scroll
const chatMessages = document.getElementById('chatMessages');
if(chatMessages){
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// ================= COMENTÁRIOS =================
document.addEventListener('DOMContentLoaded', function() {

    let currentPostId = null;

    // Clique direito diretamente nos posts
    document.querySelectorAll('.chat-post').forEach(function(post){

        post.addEventListener('contextmenu', function(e){
            e.preventDefault();

            currentPostId = this.dataset.postId;

            // Se já existir input, não cria outro
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
