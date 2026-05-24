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
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">{{ __('messages.Create Room') }}</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/ajouter.png" alt="Imagem do Formulário" style="height: 50px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                <form action="{{ route('salas.store') }}" method="POST">
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
                        <label for="name" class="form-label">{{ __('messages.Room Name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                
                    <div class="col-md-6">
                        <label for="reservar" class="form-label">{{ __('messages.Booking') }}</label>
                        <select class="form-control" name="reservar" id="reservar">
                            <option value="">Selecione</option>
                            <option value="Sim" {{ old('reservar') == 'Sim' ? 'selected' : '' }}>{{ __('messages.Yes') }}</option>
                            <option value="Nao" {{ old('reservar') == 'Nao' ? 'selected' : '' }}>{{ __('messages.No') }}</option>
                        </select>
                    </div>
                
                    <div class="col-md-6">
                        <label for="categoria" class="form-label">{{ __('messages.Category') }}</label>
                        <select class="form-control" name="categoria" id="categoria">
                            <option value="">Selecione</option>
                            <option value="Cours" {{ old('categoria') == 'Cours' ? 'selected' : '' }}>{{ __('messages.Course') }}</option>
                            <option value="Seminaire" {{ old('categoria') == 'Seminaire' ? 'selected' : '' }}>{{ __('messages.Seminar') }}</option>
                            <option value="Workshop" {{ old('categoria') == 'Workshop' ? 'selected' : '' }}>{{ __('messages.Workshop') }}</option>
                            <option value="Conference" {{ old('categoria') == 'Conference' ? 'selected' : '' }}>{{ __('messages.Conference') }}</option>
                            <option value="Autres" {{ old('categoria') == 'Autres' ? 'selected' : '' }}>{{ __('messages.Others') }}</option>
                        </select>
                    </div>
                
                    <div class="col-md-6">
                        <label for="capacidade" class="form-label">{{ __('messages.Capacity') }}</label>
                        <input type="number" class="form-control" name="capacidade" value="{{ old('capacidade') }}">
                    </div>
                
                    <div class="col-md-6">
                        <label for="edificio_id" class="form-label">{{ __('messages.Building Name') }}</label>
                        <select class="form-control" name="edificio_id" id="edificio_id">
                            <option value="">Selecione um edifício</option>
                            @foreach($edificios as $edificio)
                                <option value="{{ $edificio->id }}" 
                                    {{ old('edificio_id') == $edificio->id ? 'selected' : '' }}>
                                    {{ $edificio->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="col-md-12">
                        <label for="caracteristicas" class="form-label">{{ __('messages.Room caracteristics') }}</label>
                        <textarea class="form-control" name="caracteristicas" rows="4">{{ old('caracteristicas') }}</textarea>
                    </div>
                
                    <div class="col-md-6">
                        <label for="localizacao" class="form-label">{{ __('messages.Room Location') }}</label>
                        <input type="text" class="form-control" name="localizacao" value="{{ old('localizacao') }}">
                    </div>
                
                    <div class="col-md-6">
                        <label for="imagem" class="form-label">{{ __('messages.Image') }}</label>
                        <input type="text" class="form-control" name="imagem" value="{{ old('imagem') }}">
                    </div>
                
                    <button type="submit" class="mt-3">{{ __('messages.Save') }}</button>
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
