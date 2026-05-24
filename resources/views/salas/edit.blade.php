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
   @include('partials.sidebargestacad')


    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">EDITER SALLE</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/modif01.png" alt="Imagem do Formulário" style="height: 50px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                
                
                <form action="{{ route('salas.update', $sala->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    
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
                        <input type="text" class="form-control" name="name" value="{{ old('name', $sala->name) }}">
                    </div>
                
                    <div class="col-md-6">
                        <label for="reservar" class="form-label">Reserver</label>
                        <select class="form-control" name="reservar" id="reservar">
                            <option value="">Selecione</option>
                            <option value="Sim" {{ old('reservar', $sala->reservar ?? '') == 'Sim' ? 'selected' : '' }}>Sim</option>
                            <option value="Nao" {{ old('reservar', $sala->reservar ?? '') == 'Nao' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                
                    <div class="col-md-6">
                        <label for="categoria" class="form-label">Categorie</label>
                        <select class="form-control" name="categoria" id="categoria">
                            <option value="">Selecione</option>
                            <option value="Cours" {{ old('categoria', $sala->categoria ?? '') == 'Cours' ? 'selected' : '' }}>Cours</option>
                            <option value="Seminaire" {{ old('categoria', $sala->categoria ?? '') == 'Seminaire' ? 'selected' : '' }}>Seminaire</option>
                            <option value="Workshop" {{ old('categoria', $sala->categoria ?? '') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="Autres" {{ old('categoria', $sala->categoria ?? '') == 'Autres' ? 'selected' : '' }}>Autres</option>
                        </select>
                    </div>
                
                    <div class="col-md-6">
                        <label for="capacidade" class="form-label">Capacité</label>
                        <input type="number" class="form-control" name="capacidade" value="{{ old('capacidade', $sala->capacidade) }}">
                    </div>
                
                    <div class="col-md-6">
                        <label for="edificio_id" class="form-label">Edifice</label>
                        <select class="form-control" name="edificio_id" id="edificio_id">
                            <option value="">Selecione um edifício</option>
                            @foreach($edificios as $edificio)
                                <option value="{{ $edificio->id }}" 
                                    {{ old('edificio_id', isset($sala) ? $sala->edificio_id : null) == $edificio->id ? 'selected' : '' }}>
                                    {{ $edificio->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="col-md-12">
                        <label for="caracteristicas" class="form-label">Característiques</label>
                        <textarea class="form-control" name="caracteristicas" rows="4">{{ old('caracteristicas', $sala->caracteristicas) }}</textarea>
                    </div>
                
                    <div class="col-md-6">
                        <label for="localizacao" class="form-label">Localisation</label>
                        <input type="text" class="form-control" name="localizacao" value="{{ old('localizacao', $sala->localizacao) }}">
                    </div>
                
                    <div class="col-md-6">
                        <label for="imagem" class="form-label">Image</label>
                        <input type="text" class="form-control" name="imagem" value="{{ old('imagem', $sala->imagem) }}">
                    </div>
                
                    

                    <button type="submit" class="mt-3">Actualiser</button>
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
