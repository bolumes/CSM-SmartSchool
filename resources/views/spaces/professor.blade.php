<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>CSM-SmartSchool</title>


    <!-- =====================================================
         FONT AWESOME
    ====================================================== -->

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    >


    <!-- =====================================================
         CSS CHAT
    ====================================================== -->

    <link
        rel="stylesheet"
        href="{{ asset('css/style_chat.css') }}"
    >


    <!-- =====================================================
         FAVICON
    ====================================================== -->

    <link
        rel="icon"
        href="{{ asset('img/books.png') }}"
    >

</head>


<body>


<!-- =========================================================
     NAVBAR
========================================================= -->

<div class="navbar">


    <!-- MENU -->

    <div
        class="menu-toggle"
        onclick="toggleMenu()"
    >
        ☰
    </div>


    <!-- LOGO -->

    <div class="logo">

        <img
            src="{{ asset('img/logo.png') }}"
            alt="Logo"
        >

    </div>


    <!-- PESQUISA -->

    <div class="search">

        <input
            type="text"
            placeholder="Pesquisar..."
        >

    </div>

</div>


<!-- =========================================================
     SIDEBAR
========================================================= -->

@include('partials.sidebargestchat')


<!-- =========================================================
     CONFIGURAÇÃO DO CHAT
========================================================= -->

@php

    /*
    |--------------------------------------------------------------------------
    | TIPO DO CHAT
    |--------------------------------------------------------------------------
    */

    $spaceType = 'professor';


    /*
    |--------------------------------------------------------------------------
    | CLASSES DINÂMICAS
    |--------------------------------------------------------------------------
    */

    $fieldsetClass =
        'chat-fieldset chat-fieldset-' . $spaceType;

    $containerClass =
        'chat-container chat-container-' . $spaceType;

@endphp


<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<div class="main-content chat-page">


    <!-- =====================================================
         CHAT CARD
    ====================================================== -->

    <div class="chat-card">


        <!-- =================================================
             HEADER DO CARD
        ================================================== -->

        <div class="chat-card-header">


            <!-- TÍTULO -->

            <div class="chat-title">

                <span class="chat-title-icon">
                    👨‍🏫
                </span>

                <div>

                    <h2>
                        CHAT PROFESSEURS
                    </h2>

                    <p>
                        Espaço de comunicação entre professores
                    </p>

                </div>

            </div>


            <!-- =================================================
                 INFORMAÇÕES DO ESPAÇO
            ================================================== -->

            <div class="chat-space-info">

                <h3>
                    {{ $space->name }}
                </h3>

                @if($space->description)

                    <p>
                        {{ $space->description }}
                    </p>

                @endif

            </div>

        </div>


        <!-- =================================================
             CHAT WRAPPER
        ================================================== -->

        <div class="chat-wrapper">


            <!-- =================================================
                 CHAT CONTAINER
            ================================================== -->

            <div class="{{ $containerClass }}">


                <!-- =================================================
                     MENSAGENS
                ================================================== -->

                <div
                    class="chat-messages"
                    id="chatMessages"
                >


                    @forelse($space->posts as $post)


                        @php

                            $isMine =
                                $post->user_id === auth()->id();

                        @endphp


                        <!-- =================================================
                             POST
                        ================================================== -->

                        <div
                            class="chat-post {{ $isMine ? 'mine' : 'other' }}"
                            data-post-id="{{ $post->id }}"
                        >


                            <div class="content">


                                <!-- =================================================
                                     MENSAGEM
                                ================================================== -->

                                @if($post->content)

                                    <p>
                                        {{ $post->content }}
                                    </p>

                                @endif


                                <!-- =================================================
                                     ANEXOS
                                ================================================== -->

                                @if(
                                    $post->attachments &&
                                    $post->attachments->count()
                                )

                                    <div class="chat-attachments">


                                        @foreach($post->attachments as $file)


                                            @if(
                                                str_starts_with(
                                                    $file->file_type,
                                                    'image'
                                                )
                                            )


                                                <!-- IMAGEM -->

                                                <div class="attachment-image">

                                                    <img
                                                        src="{{ asset('storage/' . $file->file_path) }}"
                                                        alt="{{ $file->file_name }}"
                                                        style="
                                                            max-width:200px;
                                                            max-height:200px;
                                                            display:block;
                                                            margin-top:5px;
                                                            border-radius:8px;
                                                        "
                                                    >

                                                </div>


                                            @else


                                                <!-- FICHEIRO -->

                                                <div class="attachment-file">

                                                    <a
                                                        href="{{ asset('storage/' . $file->file_path) }}"
                                                        target="_blank"
                                                    >

                                                        <i class="fas fa-paperclip"></i>

                                                        {{ $file->file_name }}

                                                    </a>

                                                </div>


                                            @endif


                                        @endforeach


                                    </div>

                                @endif


                                <!-- =================================================
                                     META DA MENSAGEM
                                ================================================== -->

                                <span class="meta">


                                    {{ $isMine
                                        ? 'Você'
                                        : ($post->user->email ?? 'Utilizador')
                                    }}


                                    |


                                    {{ $post->created_at->diffForHumans() }}


                                </span>


                                <!-- =================================================
                                     COMENTÁRIOS
                                ================================================== -->

                                @if($post->comments->count())


                                    <div class="chat-comments">


                                        @foreach($post->comments as $comment)


                                            @php

                                                $isCommentMine =
                                                    $comment->user_id === auth()->id();

                                            @endphp


                                            <!-- =================================================
                                                 COMENTÁRIO
                                            ================================================== -->

                                            <div
                                                class="chat-comment {{ $isCommentMine ? 'mine' : 'other' }}"
                                            >


                                                <div class="content">


                                                    @if($comment->content)

                                                        <p>
                                                            {{ $comment->content }}
                                                        </p>

                                                    @endif


                                                    <span class="meta">


                                                        {{ $isCommentMine
                                                            ? 'Você'
                                                            : ($comment->user->email ?? 'Utilizador')
                                                        }}


                                                        |


                                                        {{ $comment->created_at->diffForHumans() }}


                                                    </span>


                                                </div>


                                            </div>


                                        @endforeach


                                    </div>


                                @endif


                            </div>


                        </div>


                    @empty


                        <!-- =================================================
                             SEM MENSAGENS
                        ================================================== -->

                        <div class="chat-empty">

                            <i class="fas fa-comments"></i>

                            <h3>
                                Nenhuma mensagem
                            </h3>

                            <p>
                                Seja o primeiro a enviar uma mensagem.
                            </p>

                        </div>


                    @endforelse


                </div>


                <!-- =================================================
                     FORMULÁRIO DE MENSAGEM
                ================================================== -->

                <form
                    action="{{ route('spaces.message.store', $space->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="chat-form"
                >

                    @csrf


                    <div class="input-wrapper">


                        <!-- =================================================
                             BOTÃO ANEXAR FICHEIRO
                        ================================================== -->

                        <label
                            for="fileUpload"
                            class="file-button"
                            title="Anexar ficheiro"
                        >

                            <i class="fas fa-paperclip"></i>

                        </label>


                        <input
                            type="file"
                            id="fileUpload"
                            name="attachments[]"
                            multiple
                            hidden
                        >


                        <!-- =================================================
                             INPUT DA MENSAGEM
                        ================================================== -->

                        <input
                            type="text"
                            name="content"
                            placeholder="Escreva sua mensagem..."
                            class="chat-input"
                            autocomplete="off"
                        >


                        <!-- =================================================
                             BOTÃO ENVIAR
                        ================================================== -->

                        <button
                            type="submit"
                            class="send-button"
                            title="Enviar mensagem"
                        >

                            <i class="fas fa-paper-plane"></i>

                        </button>


                    </div>


                    <!-- =================================================
                         FICHEIROS SELECIONADOS
                    ================================================== -->

                    <div
                        id="selectedFiles"
                        class="selected-files"
                    ></div>


                </form>


            </div>


        </div>


    </div>


</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


/*
|--------------------------------------------------------------------------
| SIDEBAR
|--------------------------------------------------------------------------
*/

function toggleMenu() {

    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("overlay");


    if (!sidebar || !overlay) {

        return;

    }


    sidebar.classList.toggle("open");

    overlay.classList.toggle("active");

}


/*
|--------------------------------------------------------------------------
| SUBMENU
|--------------------------------------------------------------------------
*/

function toggleSubmenu(element) {

    if (!element) {

        return;

    }


    element.classList.toggle("open");


    const submenu =
        element.nextElementSibling;


    if (!submenu) {

        return;

    }


    if (submenu.style.display === "flex") {

        submenu.style.display = "none";

    } else {

        submenu.style.display = "flex";

    }

}


/*
|--------------------------------------------------------------------------
| AUTO SCROLL DO CHAT
|--------------------------------------------------------------------------
*/

const chatMessages =
    document.getElementById('chatMessages');


if (chatMessages) {

    chatMessages.scrollTop =
        chatMessages.scrollHeight;

}


/*
|--------------------------------------------------------------------------
| COMENTÁRIOS
|--------------------------------------------------------------------------
|
| Botão direito do rato sobre uma mensagem
| abre o campo de comentário.
|
*/

document.addEventListener(
    'DOMContentLoaded',
    function () {


        document
            .querySelectorAll('.chat-post')
            .forEach(function (post) {


                post.addEventListener(
                    'contextmenu',
                    function (e) {


                        e.preventDefault();


                        const currentPostId =
                            this.dataset.postId;


                        /*
                        |--------------------------------------------------------------------------
                        | EVITAR DUPLICAR INPUT
                        |--------------------------------------------------------------------------
                        */

                        if (
                            this.querySelector(
                                '.comment-input'
                            )
                        ) {

                            return;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | FORM
                        |--------------------------------------------------------------------------
                        */

                        const form =
                            document.createElement('form');


                        form.method =
                            'POST';


                        form.action =
                            "{{ url('/posts') }}/"
                            + currentPostId
                            + "/comment";


                        /*
                        |--------------------------------------------------------------------------
                        | CSRF
                        |--------------------------------------------------------------------------
                        */

                        const token =
                            document.createElement('input');


                        token.type =
                            'hidden';


                        token.name =
                            '_token';


                        token.value =
                            "{{ csrf_token() }}";


                        /*
                        |--------------------------------------------------------------------------
                        | INPUT
                        |--------------------------------------------------------------------------
                        */

                        const input =
                            document.createElement('input');


                        input.type =
                            'text';


                        input.name =
                            'content';


                        input.classList.add(
                            'comment-input'
                        );


                        input.placeholder =
                            'Escreva seu comentário...';


                        input.required =
                            true;


                        /*
                        |--------------------------------------------------------------------------
                        | ADICIONAR AO FORM
                        |--------------------------------------------------------------------------
                        */

                        form.appendChild(token);

                        form.appendChild(input);


                        /*
                        |--------------------------------------------------------------------------
                        | ADICIONAR AO POST
                        |--------------------------------------------------------------------------
                        */

                        this
                            .querySelector('.content')
                            .appendChild(form);


                        input.focus();


                        /*
                        |--------------------------------------------------------------------------
                        | ENTER PARA ENVIAR
                        |--------------------------------------------------------------------------
                        */

                        input.addEventListener(
                            'keydown',
                            function (e) {


                                if (
                                    e.key === 'Enter'
                                ) {


                                    e.preventDefault();


                                    form.submit();


                                }

                            }
                        );


                    }
                );


            });


    }
);


/*
|--------------------------------------------------------------------------
| FICHEIROS SELECIONADOS
|--------------------------------------------------------------------------
*/

const fileUpload =
    document.getElementById('fileUpload');

const selectedFiles =
    document.getElementById('selectedFiles');


if (fileUpload && selectedFiles) {


    fileUpload.addEventListener(
        'change',
        function () {


            selectedFiles.innerHTML = '';


            if (!this.files.length) {

                return;

            }


            Array
                .from(this.files)
                .forEach(function (file) {


                    const item =
                        document.createElement('div');


                    item.classList.add(
                        'selected-file'
                    );


                    item.innerHTML =
                        '<i class="fas fa-paperclip"></i> '
                        + file.name;


                    selectedFiles.appendChild(
                        item
                    );


                });


        }
    );


}


/*
|--------------------------------------------------------------------------
| ENTER PARA ENVIAR MENSAGEM
|--------------------------------------------------------------------------
*/

const chatInput =
    document.querySelector('.chat-input');


if (chatInput) {


    chatInput.addEventListener(
        'keydown',
        function (e) {


            if (
                e.key === 'Enter' &&
                !e.shiftKey
            ) {


                e.preventDefault();


                const form =
                    this.closest('form');


                if (form) {

                    form.submit();

                }


            }

        }
    );


}

</script>


</body>

</html>