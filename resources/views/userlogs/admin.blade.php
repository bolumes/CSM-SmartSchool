<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/books.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Estilos adicionais para o botão de pesquisa */
        tr {
            height: 40px;
        }

        tr:hover {
            height: 40px;
            background-color: #afc393;
            cursor: pointer;
            color: blue;
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


        .zoom-container {
        position: relative;
        display: inline-block;
        }

        .zoom-container img {
            width: 100%;
            transition: transform 0.3s ease;
        }

        .zoom-container:hover img {
            transform: scale(1.5);  /* Aumenta o zoom da imagem */
            cursor: pointer;
        }

        /* Estilo opcional para melhorar o efeito visual */
        .zoom-container img:active {
            transform: scale(1.5); /* Amplia quando a imagem é clicada */
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
    </div>


    <!--partials sidebar-->
   @include('partials.sidebarwelcome')
   
    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue;">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">LISTES D'ANONCES</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">

            <!-- Seção do Formulário -->
            <div class="form-container">

                @php
                $userFunction = Auth::user()->function;
                $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
            @endphp

            
        <table>
            <tbody bgcolor="#d7dbdd">
                @php
                    // Agrupar logs por função
                    $groupedLogs = $logs->groupBy(function ($log) {
                        return strtolower($log->function);
                    });
                @endphp

                @foreach ($groupedLogs as $function => $functionLogs)
                    <tr class="user-type-row" data-user-type="{{ $function }}">
                        <td colspan="6" class="user-type-name" style="cursor: pointer; font-weight: bold; background-color: #1c359d; color: white;">
                            {{ ucfirst($function) }} Logs
                        </td>
                    </tr>

                    <tr class="user-logs-list" data-user-type="{{ $function }}">
                        <td colspan="6">
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Login</th>
                                        <th>Logout</th>
                                        <th>IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($functionLogs as $log)
                                        <tr align="center">
                                            <td>{{ $log->user->firstname }} {{ $log->user->lastname }} ({{ $log->user->email }})</td>
                                            <td>{{ $log->logged_in_at ? $log->logged_in_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                            <td>{{ $log->logged_out_at ? $log->logged_out_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                            <td>{{ $log->ip_address ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

                <div class="form-group
   
           
            
            
            </div>
        </div>
    </fieldset>
    </div>

    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Essa ação não pode ser desfeita.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'small-popup' // Adiciona uma classe personalizada para controlar o tamanho
                },
                width: '400px' // Ajuste a largura da janela
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
    
    <style>
        /* Estilo para o SweetAlert personalizado */
        .small-popup {
            font-size: 16px; /* Ajuste o tamanho da fonte */
            padding: 20px; /* Adiciona mais espaço dentro da caixa */
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</body>
</html>

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
