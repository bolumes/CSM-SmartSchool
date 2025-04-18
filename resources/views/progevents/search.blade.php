«<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
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
        <div class="icons">
            <div class="icon" title="Notificações">🔔</div>
            <div class="icon" title="Perfil">👤</div>
            <div class="icon" title="Sair">🔓</div>
        </div>
    </div>

    <!--partials sidebar-->
   @include('partials.sidebarsettings')


    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">RECHERCHER EVENEMENT</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/procurar.png" alt="Imagem do Formulário" style="height: 80px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                <form class="d-flex align-items-center w-100 gap-2" action="{{ route('events.search') }}" method="GET">
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
                    
                    <input class="form-control me-2" type="search" name="codigo" required placeholder="Rechercher code..." aria-label="Pesquisar"> 
                    <button class="btn btn-outline-primary" type="submit">Rechercher</button>
    
                </form>
                <hr style="width: 100%; height: 2px; background-color: blue; margin-top: 20px;">
                <br

                @if(request()->filled('codigo')) <!-- Só exibe após a pesquisa -->
                @if(count($events))
                    <div class="table-responsive mt-4">
                        <table border="0" class="table table-striped align-middle">
                            <thead class="table-dark">
                                <tr style="background-color: #34495e; color: white;">
                                    <th scope="col" style="width: 10%;">Type</th>
                                    <th scope="col" style="width: 35%;">Matiere</th>
                                    <th scope="col" style="width: 35%;">Professeur</th>
                                    <th colspan="2" scope="col" style="width: 70%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr style="background-color: #d0d3d4 ; color: black;">
                                        <td align="center">{{ $event->type }}</td>
                                        <td align="center">{{ $event->matiere->code ?? '---' }}</td>
                                        <td align="center">
                                            {{ $event->professor->firstname ?? '' }} {{ $event->professor->lastname ?? '' }}
                                        </td>
                                        <td align="center" >
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-primary me-1">
                                                detalhes
                                            </a>
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                                editar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Paginação -->
                    @if(method_exists($events, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $events->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div class="alert alert-info mt-4">
                        Aucun evenement retouvé 
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
