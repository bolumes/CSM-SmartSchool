<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/favicon.png">
    <style>
        /* Estilos adicionais para o botão de pesquisa */
        tr {
            height: 40px;
        }

        tr:hover {
            height: 40px;
            cursor: pointer;
            background-color: #34495e; 
            color: white;
        }

        th {
            background-color: #1c359d;
            color: white;
        }

        /* Estilo para o SweetAlert personalizado */
        .small-popup {
            font-size: 16px; /* Ajuste o tamanho da fonte */
            padding: 20px; /* Adiciona mais espaço dentro da caixa */
        }
    </style>
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
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">RECHERCHER SALLE</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/procurar.png" alt="Imagem do Formulário" style="height: 80px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                <form class="d-flex align-items-center w-100 gap-2" action="{{ route('salas.search') }}" method="GET">
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
                    
                    <input class="form-control me-2" type="search" name="name" required placeholder="Rechercher salle..." aria-label="Pesquisar"> 
                    <button class="btn btn-outline-primary" type="submit">Rechercher</button>
    
                </form>
                <hr style="width: 100%; height: 2px; background-color: blue; margin-top: 20px;">
                <br

                @if(request()->filled('name')) <!-- Só exibe após a pesquisa -->
                @if(count($salas))
                    <div class="table-responsive mt-4">
                        <table border="0.5" class="table table-striped align-middle" >
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 10%;">ID</th>
                                    <th scope="col" style="width: 35%;">Nom</th>
                                    <th scope="col" style="width: 35%;">Localisation</th>
                                    <th colspan="2" scope="col" style="width: 70%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salas as $sala)
                                    <tr style="background: silver;">
                                        <td align="center">{{ $sala->id }}</td>
                                        <td align="center">{{ $sala->name }}</td>
                                        <td align="center">{{ $sala->categoria }}</td>
                                        <td align="center" >
                                            <a href="{{ route('salas.show', $sala->id) }}" class="btn btn-sm btn-primary me-1">
                                                <img src="../../img/det.png" alt="Editar" style="width: 30px; height: 30px;">
                                            </a>
                                        </td>
                                        <td align="center" >
                                            <a href="{{ route('salas.show', $sala->id) }}" class="btn btn-sm btn-primary me-1">
                                                <img src="../../img/modif02.png" alt="Editar" style="width: 30px; height: 30px;">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Paginação -->
                    @if(method_exists($salas, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $edificios->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div class="alert alert-info mt-4">
                        Nenhuma sala encontrado.
                    </div>
                @endif
            @endif
            


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
