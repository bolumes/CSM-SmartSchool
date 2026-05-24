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
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">EDITER ELEVE</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
                <img src="../../img/modif01.png" alt="Imagem do Formulário" style="height: 50px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">
                
                <form action="{{ route('eleve.update', ['user'=> $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if (session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                    
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
                        <input type="text" class="form-control" name="firstname"  value="{{ old('firstname', $user->firstname) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="lastname"  value="{{ old('lastname', $user->lastname) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Tephone</label>
                        <input type="text" class="form-control" name="telephone"  value="{{ old('telephone', $user->telephone) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"  value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label">Addresse</label>
                        <input type="text" class="form-control" name="address"  value="{{ old('address', $user->address) }}">
                    </div>

                    <label for="function" class="form-label">Fonction</label>
                    <select class="form-control" name="function">
                        <option value="">Choisir...</option>
                        <option value="Admin" {{ old('function', $user->function) == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Direction" {{ old('function', $user->function) == 'Direction' ? 'selected' : '' }}>Direction</option>
                        <option value="Professeur" {{ old('function', $user->function) == 'Professeur' ? 'selected' : '' }}>Professeur</option>
                        <option value="Parent" {{ old('function', $user->function) == 'Parent' ? 'selected' : '' }}>Parent</option>
                        <option value="Eleve" {{ old('function', $user->function) == 'Eleve' ? 'selected' : '' }}>Eleve</option>
                    </select>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Mot de Passe</label>
                        <input type="password" class="form-control" name="password"  value="{{ old('password') }}">
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="5">{{ old('description', $user->description) }}</textarea>
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
