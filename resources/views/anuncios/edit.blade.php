<!DOCTYPE html>
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
    </div>

    <!--partials sidebar-->
   @include('partials.sidebarwelcome')


    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">EDITER L'ANONCE</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção do Formulário -->
            <div class="form-container">
                
                <form action="{{ route('anuncios.update', $anuncio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                
                    {{-- Mensagem de sucesso --}}
                    @if (session('success'))
                        <div id="toast-success" class="toast">
                            {{ session('success') }}
                        </div>
                        <style>
                            .toast {
                                position: fixed;
                                top: 20px;
                                right: 20px;
                                background-color: #38a169;
                                color: white;
                                padding: 15px 25px;
                                border-radius: 8px;
                                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                                z-index: 9999;
                                animation: slideIn 0.5s, fadeOut 0.5s 3.5s forwards;
                            }
                            @keyframes slideIn {
                                from { opacity: 0; transform: translateY(-20px); }
                                to { opacity: 1; transform: translateY(0); }
                            }
                            @keyframes fadeOut {
                                to { opacity: 0; transform: translateY(-20px); display: none; }
                            }
                        </style>
                    @endif
                
                    {{-- Exibição de erros --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    {{-- Campos do formulário --}}
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="{{ old('date', $anuncio->date) }}" required>
                        </div>
                
                        <div class="col-md-6 mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="titre" value="{{ old('titre', $anuncio->titre) }}" required>
                        </div>
                
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ old('description', $anuncio->description) }}</textarea>
                        </div>
                
                        <div class="col-md-12 mb-3">
                            <label for="fichier" class="form-label">Fichier (.jpg ou .pdf)</label>
                            <input type="file" class="form-control" name="fichier" accept=".jpg,.jpeg,.pdf">
                            @if($anuncio->fichier)
                                <p class="mt-2">
                                    Fichier actuel:
                                    @php
                                        $filePath = asset('storage/' . $anuncio->fichier);
                                        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                    @endphp
                                    @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ $filePath }}" target="_blank"><img src="{{ $filePath }}" alt="Imagem" style="max-width: 100px;"></a>
                                    @elseif($ext === 'pdf')
                                        <a href="{{ $filePath }}" target="_blank">📄 Visualizar PDF</a>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
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
