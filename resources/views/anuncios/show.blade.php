<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
    <link rel="icon" href="{{ asset('img/books.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

    <!-- Sidebar (ajustado para o template) -->
    @include('partials.sidebarwelcome')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <fieldset style="border-radius:8px; border:2px solid blue">
            <legend style="text-align:center">
                <h3 style="color:blue">DETALHES DO ANÚNCIO</h3>
            </legend>

            <div class="container">
                <div style="text-align: center;">
                    <img src="{{ asset('img/det.png') }}" alt="Imagem do Formulário" style="height: 50px;">
                </div>

                @if(session('success'))
                    <div class="toast">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="permission-table">
                    <tbody>
                        <tr>
                            <th style="width:40%">ATRIBUTO</th>
                            <th style="width:60%">VALOR</th>
                        </tr>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td>{{ $anuncio->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Data</strong></td>
                            <td>{{ $anuncio->date }}</td>
                        </tr>
                        <tr>
                            <td><strong>Título</strong></td>
                            <td>{{ $anuncio->titre }}</td>
                        </tr>
                        <tr>
                            <td><strong>Descrição</strong></td>
                            <td>{{ $anuncio->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ficheiro</strong></td>
                            <td>
                                @php
                                    $filePath = asset('storage/' . $anuncio->fichier);
                                    $ext = strtolower(pathinfo($anuncio->fichier, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($ext, ['jpg','jpeg','png']))
                                    <img src="{{ $filePath }}" style="max-width:100px" alt="Imagem">
                                @elseif($ext === 'pdf')
                                    <img src="{{ asset('img/pdf-icon.png') }}" width="30" alt="PDF">
                                @else
                                    <a href="{{ $filePath }}" target="_blank">Ver ficheiro</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Criado em</strong></td>
                            <td>{{ $anuncio->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    

    <script>
        /* Toggle Sidebar */
        function toggleMenu() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            if (sidebar) {
                sidebar.classList.toggle("open");
            }
            if (overlay) {
                overlay.classList.toggle("active");
            }
        }

        /* Fechar sidebar ao clicar fora */
        document.getElementById("overlay")?.addEventListener("click", function() {
            const sidebar = document.getElementById("sidebar");
            if (sidebar) {
                sidebar.classList.remove("open");
            }
            this.classList.remove("active");
        });

        /* Submenu toggle (caso necessário) */
        function toggleSubmenu(element, event) {
            if (event) event.preventDefault();
            element.classList.toggle("open");
            const submenu = element.nextElementSibling;
            if (submenu) {
                submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
                if (submenu.style.display === "flex") submenu.style.flexDirection = "column";
            }
        }
    </script>
</body>

</html>