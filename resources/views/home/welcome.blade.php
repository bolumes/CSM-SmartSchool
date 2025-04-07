<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM SmartSchool</title>

    <link rel="icon" href="img/books.png">
       

    <style>
        /* Estilos Globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }
        
        /* Navbar (Barra Superior) */
        .navbar {
            background-color: #0355ad; /* Cor da navbar do YouTube */
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /*position: fixed;*/
            
        }
        

        .navbar .logo {
            width: 150px;
            height: auto;
         }

        .logo img {
            width: 145px;
            height: auto;
        }

        .navbar .search {
            flex-grow: 1;
            max-width: 600px; /* Limita o tamanho máximo da barra de pesquisa */
            margin-left: 20px; /* Adiciona um espaçamento para alinhar à esquerda */
        }

        .navbar input[type="text"] {
            width: 100%; /* Ocupa todo o espaço disponível */
            padding: 7px;
            border: none;
            border-radius: 2px;
        }

        .navbar .icons {
            display: flex;
            gap: 15px;
        }

        .navbar .icon {
            cursor: pointer;
        }

        /* Menu Lateral (Sidebar) */
        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #f9f9f9;
            position: fixed;
            top: 0;
            left: -200px; /* Inicialmente fora da tela */
            padding-top: 50px;
            transition: left 0.3s ease;
            overflow-y: auto; /* Habilita a rolagem vertical quando necessário */
        }

        .sidebar.open {
            left: 0; /* Traz o menu para a tela */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #e5e5e5;
        }

        .sidebar .icon {
            margin-right: 10px;
        }

        /* Submenu */
        .submenu {
            display: none; /* Escondido por padrão */
            flex-direction: column;
            padding-left: 20px; /* Recuo para os subitens */
        }

        .submenu a {
            font-size: 16px; /* Subitens menores */
        }

        /* Estilos para itens com submenu */
        .has-submenu {
            cursor: pointer;
        }

        .has-submenu.open + .submenu {
            display: flex; /* Mostra o submenu quando aberto */
        }

        /* Conteúdo Principal */
        .main-content {
            padding: 20px;
            margin-left: 0; /* Ajusta a margem inicial sem o menu */
            transition: margin-left 0.3s ease;
        }

        .sidebar.open ~ .main-content {
            margin-left: 200px; /* Move o conteúdo quando o menu está aberto */
        }

        /* Botão de Menu */
        .menu-toggle {
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
        }

        /* Background transparente quando o menu está aberto */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Transparente */
            display: none;
        }

        .overlay.active {
            display: block; /* Mostra o overlay quando o menu está aberto */
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo" ><img src="img/logo.png" ></div>
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
   @include('partials.sidebar')

   <!--partials welcome-->
   @include('partials.welcome')
    


    <fieldset>
        <legend>Carrosel</legend>

        <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

    </fieldset>
   
    
    <fieldset>
        <legend>Card</legend>

        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
        </div>
    </fieldset>
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Script para Toggle do Menu -->
    <script>
        function toggleMenu() {
            var sidebar = document.getElementById("sidebar");
            var overlay = document.getElementById("overlay");

            // Alterna o estado aberto/fechado do menu
            sidebar.classList.toggle("open");

            // Mostra ou esconde o overlay
            if (sidebar.classList.contains("open")) {
                overlay.classList.add("active");
            } else {
                overlay.classList.remove("active");
            }
        }

        function toggleSubmenu(element) {
            element.classList.toggle("open"); // Alterna o estado aberto/fechado do submenu
        }
    </script>
    
</body>
</html>