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
            
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th>DATA</th>
                        <th>TITRE</th>
                        <th>DOC</th>
                        <th colspan="3">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anuncios as $anuncio)
                        <tr>
                            <td align="center">{{ $anuncio->date }}</td>
                            <td align="center">{{ $anuncio->titre }}</td>  
                            
                            <td align="center">
                                @php
                                    $filePath = asset('storage/' . $anuncio->fichier);
                                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                @endphp
                            
                                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                    <!-- Imagem clicável com zoom via Lightbox -->
                                    <a href="{{ $filePath }}" data-lightbox="image-{{ $anuncio->id }}" data-title="{{ $anuncio->titre }}">
                                        <img src="{{ $filePath }}" alt="Imagem" style="max-width: 100px; height: auto;">
                                    </a>
                                @elseif(strtolower($extension) === 'pdf')
                                    <!-- Link para abrir PDF em nova aba -->
                                    <a href="{{ $filePath }}" target="_blank" title="Visualizar PDF">
                                        <img src="{{ asset('img/pdf-icon.png') }}" alt="PDF" style="width: 30px; height: 30px;">
                                    </a>
                                @else
                                    <span>Arquivo</span>
                                @endif
                            </td>
                            
                            
            
                            {{-- Ver Detalhes --}}
                            <td align="center">
                                <a href="{{ route('anuncios.show', $anuncio->id) }}" title="Ver Detalhes">
                                    <img src="{{ asset('img/det.png') }}" alt="Ver" style="width: 30px; height: 30px;">
                                </a>
                            </td>
            
                            {{-- Editar (Admin ou Direction) --}}
                            <td align="center">
                                @if ($isAdminOrDirection)
                                    <a href="{{ route('anuncios.edit', $anuncio->id) }}" title="Editar">
                                        <img src="{{ asset('img/modif02.png') }}" alt="Editar" style="width: 30px; height: 30px;">
                                    </a>
                                @else
                                    <span style="color: #ccc;">—</span>
                                @endif
                            </td>
            
                            {{-- Excluir (Admin ou Direction) --}}
                            <td align="center">
                                @if ($isAdminOrDirection)
                                    <form id="delete-form-{{ $anuncio->id }}" action="{{ route('anuncios.destroy', $anuncio->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" onclick="confirmDelete({{ $anuncio->id }})" style="background: none; border: none; cursor: pointer;" title="Excluir">
                                        <img src="{{ asset('img/del0.png') }}" alt="Excluir" style="width: 30px; height: 30px;">
                                    </button>
                                @else
                                    <span style="color: #ccc;">—</span>
                                @endif
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
        function confirmDelete(anuncioId) {
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
                    popup: 'small-popup'
                },
                width: '400px'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + anuncioId);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Formulário não encontrado para o anúncio ID:', anuncioId);
                    }
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
