<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/favicon.png">
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
    @include('partials.sidebar1')

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">LISTA USERS</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">

            <!-- Seção do Formulário -->
            <div class="form-container">

                <table border="1" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Apelido</th>
                            <th>Email</th>
                            <th colspan="3">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td align="center">{{ $user->id }}</td>
                                <td align="center">{{ $user->firstname }}</td>
                                <td align="center">{{ $user->lastname }}</td>
                                <td align="center">{{ $user->email }}</td>
                                
                                {{-- Botão "Ver Detalhes" --}}
                                <td align="center">
                                    <a href="{{ route('users.show', ['user' => $user]) }}">
                                        <img src="../../img/det.png" alt="Ver" style="width: 30px; height: 30px;">
                                    </a>
                                </td>
                                
                                {{-- Botão "Editar" --}}
                                <td align="center">
                                    <a href="{{ route('users.edit', ['user' => $user]) }}">
                                        <img src="../../img/modif02.png" alt="Editar" style="width: 30px; height: 30px;">
                                    </a>
                                </td>

                                {{-- Botão "Suprimir" --}}
                                <td align="center">
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <button type="button" onclick="confirmDelete({{ $user->id }})" style="background: none; border: none; cursor: pointer;">
                                        <img src="../../img/del0.png" alt="Suprimir" style="width: 30px; height: 30px;">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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

    
    
</body>
</html>
