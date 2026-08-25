<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../../img/books.png">

    <style>
        .post-card{
            padding:15px;
            border:1px solid #e5e7eb;
            border-radius:10px;
            background:white;
            margin-bottom:15px;
        }

        .comment-box{
            margin-top:12px;
            padding-left:10px;
            border-left:2px solid #eee;
        }

        .file-preview img{
            max-width:220px;
            border-radius:10px;
            margin-top:8px;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo"><img src="../../img/logo.png"></div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

    @include('partials.sidebarwelcome')

    <!-- MAIN -->
    <div class="main-content">

        <fieldset style="border-radius:8px; border:2px solid blue; padding:15px;">

            <legend style="text-align:center;">
                <h3 style="color:blue;">CREER PROFESSEUR</h3>
            </legend>

            <div class="container">

                <div class="form-image">
                    <img src="../../img/ajouter.png" style="height:50px; margin-left:40px;">
                </div>

                <div class="form-container">

                    @extends('layouts.app')
                    @section('content')

                    <div class="container mx-auto p-4">

                        <!-- SPACE INFO -->
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold">{{ $space->name }}</h1>
                            <p class="text-gray-600">{{ $space->description }}</p>
                            <p class="text-sm text-gray-400">
                                Criado por: {{ $space->creator->name }}
                            </p>
                        </div>

                        <!-- FORMULÁRIO MELHORADO -->
                        <div class="mb-6">

                            <h2 class="text-xl font-semibold mb-3">Nova Mensagem</h2>

                            <form action="{{ route('spaces.message.store', $space->id) }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  style="background:#f9fafb; padding:15px; border-radius:10px; border:1px solid #e5e7eb;">

                                @csrf

                                <textarea name="content"
                                          rows="3"
                                          placeholder="Escreva sua mensagem..."
                                          style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db; resize:none;">
                                </textarea>

                                <div style="margin-top:10px; display:flex; align-items:center; gap:10px;">

                                    <input type="file"
                                           name="file"
                                           style="border:1px solid #ccc; padding:5px; border-radius:6px;">

                                    <small style="color:gray;">
                                        📎 Imagens / PDFs / ficheiros
                                    </small>

                                </div>

                                <div style="margin-top:12px; display:flex; justify-content:flex-end;">

                                    <button type="submit"
                                            style="background:#2563eb; color:white; padding:8px 14px; border:none; border-radius:6px;">
                                        Enviar
                                    </button>

                                </div>

                            </form>

                        </div>

                        <!-- POSTS -->
                        <div class="space-y-6">

                            @foreach($space->posts as $post)

                            <div class="post-card">

                                <!-- TEXTO -->
                                <p>{{ $post->content }}</p>

                                <small style="color:gray;">
                                    Enviado por: {{ $post->user->name }}
                                    • {{ $post->created_at->diffForHumans() }}
                                </small>

                                <!-- FILE -->
                                @if($post->file)

                                    <div class="file-preview">

                                        @php
                                            $ext = pathinfo($post->file, PATHINFO_EXTENSION);
                                        @endphp

                                        @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                            <img src="{{ asset('storage/'.$post->file) }}">
                                        @else
                                            <div style="margin-top:8px;">
                                                <a href="{{ asset('storage/'.$post->file) }}" target="_blank">
                                                    📎 Download ficheiro
                                                </a>
                                            </div>
                                        @endif

                                    </div>

                                @endif

                                <!-- COMMENTS -->
                                <div class="comment-box">

                                    @foreach($post->comments as $comment)

                                    <div style="margin-bottom:8px;">
                                        <p style="margin:0;">{{ $comment->content }}</p>
                                        <small style="color:gray;">
                                            {{ $comment->user->name }}
                                            • {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                    @endforeach

                                    <!-- COMMENT FORM -->
                                    <form action="{{ route('posts.comment.store', $post->id) }}"
                                          method="POST"
                                          style="margin-top:10px;">

                                        @csrf

                                        <input type="text"
                                               name="content"
                                               placeholder="Escreva um comentário..."
                                               style="width:100%; padding:8px; border:1px solid #d1d5db; border-radius:6px;">

                                        <button type="submit"
                                                style="margin-top:5px; background:#16a34a; color:white; padding:6px 10px; border:none; border-radius:6px;">
                                            Comentar
                                        </button>

                                    </form>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    @endsection

                </div>

            </div>

        </fieldset>

    </div>

    <script>
        function toggleMenu() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            sidebar.classList.toggle("open");
            overlay.classList.toggle("active");
        }

        function toggleSubmenu(element) {
            element.classList.toggle("open");
            const submenu = element.nextElementSibling;
            submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
        }
    </script>

</body>
</html>