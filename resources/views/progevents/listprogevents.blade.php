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
   @include('partials.sidebarsettings')
   
    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue;">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">LISTES EVEN-PROG</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">

            <!-- Seção do Formulário -->
            <div class="form-container">

                @php
                $userFunction = Auth::user()->function;
                $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
            @endphp
            
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Matéria</th>
                        <th>Salle</th>
                        <th>Professor</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($progevents as $progevent)
                        <tr>
                            <td align="center">{{ $progevent->id }}</td>
            
                            <!-- Exibindo 'type' da matéria relacionada ao evento -->
                            <td align="center">
                                {{ $progevent->event?->type ?? 'N/A' }}
                            </td>
            
                            <!-- Exibindo 'code' da matéria relacionada ao evento -->
                            <td align="center">
                                {{ $progevent->event?->matiere?->code ?? 'N/A' }}
                            </td>

                            <!-- Exibindo 'sala' da matéria relacionada ao evento -->
                            <td align="center">
                                {{ $progevent->sala?->name ?? 'N/A' }}
                            </td>
            
                            <!-- Exibindo o nome do professor relacionado ao evento -->
                            <td align="center">
                                {{ $progevent->event?->professor?->firstname }} {{ $progevent->event?->professor?->lastname }}
                            </td>
            
                            <td align="center">
                                <a href="{{ route('progevents.show', $progevent->id) }}" title="Ver detalhes">
                                    <img src="{{ asset('img/det.png') }}" alt="Ver" style="width: 30px; height: 30px;">
                                </a>
                            </td>
                            
                            @if ($isAdminOrDirection)
                                <td align="center">
                                
                                        <a href="{{ route('progevents.edit', ['progevent' => $progevent->id]) }}" title="Editar">
                                            <img src="{{ asset('img/modif02.png') }}" alt="Editar" style="width: 30px; height: 30px;">
                                        </a>
                                </td>
                            @else
                               <span style="color: #ccc;">—</span>
                            @endif
            
                            @if ($isAdminOrDirection)
                                <td align="center">
                                        <form id="delete-form-{{ $progevent->id }}" action="{{ route('progevents.destroy', $progevent->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                
                                        <button onclick="confirmDelete({{ $progevent->id }})" style="background: none; border: none;" title="Excluir">
                                            <img src="{{ asset('img/del0.png') }}" alt="Excluir" style="width: 30px; height: 30px;">
                                        </button>  
                                </td>
                            @else
                                <span style="color: #ccc;">—</span>
                            @endif
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
