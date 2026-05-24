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
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/books.png">
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo" ><img src="../../img/logo.png" ></div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

   <!--partials sidebar-->
   @include('partials.sidebarwelcome')

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">CREER PROFESSEUR</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/ajouter.png" alt="Imagem do Formulário" style="height: 50px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                
                @extends('layouts.app')

                @section('content')
                <div class="container mx-auto p-4">

                    {{-- Espaço --}}
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold">{{ $space->name }}</h1>
                        <p class="text-gray-600">{{ $space->description }}</p>
                        <p class="text-sm text-gray-400">Criado por: {{ $space->creator->name }}</p>
                    </div>

                    {{-- Formulário para criar post --}}
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Nova Mensagem</h2>
                        <form action="{{ route('spaces.message.store', $space->id) }}" method="POST">
                            @csrf
                            <textarea name="content" rows="3" placeholder="Escreva sua mensagem..." class="w-full p-2 border rounded" required></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Enviar</button>
                        </form>
                    </div>

                    {{-- Lista de posts --}}
                    <div class="space-y-6">
                        @foreach($space->posts as $post)
                        <div class="p-4 border rounded">
                            <p class="text-gray-800">{{ $post->content }}</p>
                            <p class="text-sm text-gray-500">Enviado por: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>

                            {{-- Lista de comentários do post --}}
                            <div class="mt-4 ml-4 space-y-2">
                                @foreach($post->comments as $comment)
                                <div class="p-2 border-l border-gray-300">
                                    <p>{{ $comment->content }}</p>
                                    <p class="text-xs text-gray-400">Comentado por: {{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                                @endforeach

                                {{-- Formulário para criar comentário --}}
                                <form action="{{ route('posts.comment.store', $post->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="text" name="content" placeholder="Escreva um comentário..." class="w-full p-2 border rounded" required>
                                    <button type="submit" class="mt-1 px-3 py-1 bg-green-600 text-white rounded text-sm">Comentar</button>
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

    <!-- Script para Toggle do Menu -->
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





