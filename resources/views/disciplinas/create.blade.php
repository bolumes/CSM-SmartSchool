<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/favicon.png">
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo" ><img src="../../img/logo.png" ></div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
        <div class="icons">
            <div class="icon" title="Notificações">🔔</div>
            <div class="icon" title="Perfil">👤</div>
            <div class="icon" title="Sair">🔓</div>
        </div>
    </div>

    <!--partials sidebar-->
    @include('partials.sidebar')


    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">CREER MATIERE</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/ajouter.png" alt="Imagem do Formulário" style="height: 80px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                <form action="{{ route('disciplina-store') }}" method="POST">
                    @csrf
                       
                    <!-- Mensagem flutuante -->
                    @if (session('success'))
                    <div id="toast-success" class="toast">
                        {{ session('success') }}
                    </div>
                
                    <style>
                        .toast {
                            position: fixed;
                            top: 20px;
                            right: 20px;
                            background-color: #38a169; /* verde */
                            color: white;
                            padding: 15px 25px;
                            border-radius: 8px;
                            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                            z-index: 9999;
                            animation: slideIn 0.5s, fadeOut 0.5s 3.5s forwards;
                        }
                
                        @keyframes slideIn {
                            from {
                                opacity: 0;
                                transform: translateY(-20px);
                            }
                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }
                
                        @keyframes fadeOut {
                            to {
                                opacity: 0;
                                transform: translateY(-20px);
                                display: none;
                            }
                        }
                    </style>
                    @endif
                
                    @if ($errors->any())
                        <p style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </p>
                    @endif
                
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="codigo" class="form-label">Code</label>
                        <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}">
                    </div>
                                             
                    <div class="col-md-12">
                        <label for="descricao" class="form-label">Description</label>
                        <textarea class="form-control" name="descricao" rows="4">{{ old('descricao') }}</textarea>
                    </div>
                
                    <button type="submit" class="mt-3">Enregistrer</button>
                </form>
                
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
