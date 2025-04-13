<!DOCTYPE html>
<html lang="pt-PT">
<head>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM SmartSchool</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/books.jpg">
    <style>
        /* Estilos Globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Impede que a página tenha scroll horizontal */
        }

        /* Navbar (Barra Superior) */
        .navbar {
            background-color: #0355ad;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo img {
            width: 145px;
            height: auto;
        }

        .navbar .search {
            flex-grow: 1;
            max-width: 600px;
            margin-left: 20px;
        }

        .navbar input[type="text"] {
            width: 100%;
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
            position: fixed;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #f9f9f9;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 20px;
        }

        .sidebar.open {
            width: 180px; /* Largura do menu */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            margin: 0;
        }

        .sidebar a:hover {
            background-color: #e5e5e5;
        }

        .submenu a {
            font-size: 15px;
            padding: 5px 15px;
        }

        .submenu {
            display: none;
            flex-direction: column;
            padding-left: 15px;
        }

        .has-submenu.open + .submenu {
            display: flex;
        }

        .sidebar .has-submenu {
            margin-bottom: 10px;
        }

        .sidebar hr {
            margin: 5px 0;
        }

        /* Ajuste do conteúdo principal */
        .main-content {
            padding: 20px;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .main-content.sidebar-open {
            margin-left: 180px; /* Desloca o conteúdo para a direita quando o menu é aberto */
        }

        .menu-toggle {
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Carousel */
        .carousel-inner img {
            max-height: 500px;
            object-fit: cover;
        }

       /* cpy */
        .cpy-right {
              padding: 1em;
              background: #6887ff;
          }

          .cpy-right p {
              color: #fff;
          }

          .cpy-right p a {
              color: #fff;
          }

          .language-switcher a {
              margin: 0 5px;
              text-decoration: none;
              font-size: 20px;
          }


          /* Contact Section */
    .contact-section {
        background: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin: 2rem auto;
        padding: 2rem;
    }

    .contact-header {
        position: relative;
        margin-bottom: 2.5rem;
    }

    .contact-header h4 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        position: relative;
        display: inline-block;
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .contact-info-item {
        transition: all 0.3s ease;
        padding: 1.2rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .contact-info-item:hover {
        background: rgba(79, 172, 254, 0.05);
        transform: translateX(10px);
    }

    .contact-info-item i {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        color: white;
        font-size: 1.4rem;
    }

    .contact-form label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }

    .contact-form .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }

    .contact-form .form-control:focus {
        border-color: #4facfe;
        box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.25);
    }

    .submit-btn {
        font-weight: 600;
        letter-spacing: 0.5px;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        transition: all 0.3s ease !important;
        position: relative;
        overflow: hidden;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
    }

    @media (max-width: 768px) {
        .contact-section {
            padding: 1.5rem;
            margin: 1rem;
        }
        
        .contact-info-item {
            margin-bottom: 1rem;
        }
        
        .contact-form .row {
            gap: 1rem;
        }
    }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo"><img src="img/logo.png" alt="SmartSchool Logo"></div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

  
    <!--partials sidebar-->
   @include('partials.sidebarlogin')
   

    <!-- Conteúdo Principal -->
    <div class="main-content" id="main-content">
        <h2 class="text-primary">Bienvenue au Csm-SmartSchool</h2>
        <p class="text-primary">Plataforme de Gestion - Complexe scolaire Multinacional</p>

        
<br>

<h2 class="text-center text-primary">Login</h2>

 <!-- Verificar se há uma mensagem de erro -->
 @if(session('error'))
 <div class="alert alert-danger">
     {{ session('error') }}
 </div>
@endif

<fieldset style="border: #5833ed 2px solid; border-radius: 10px; padding: 20px; background-color: #f8f9fa;"> 
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
        </button>
    </form>

    
</fieldset>





<script>
     function toggleMenu() {
         const sidebar = document.getElementById("sidebar");
         const overlay = document.getElementById("overlay");
         const mainContent = document.getElementById("main-content");

         sidebar.classList.toggle("open");
         overlay.classList.toggle("active");
         mainContent.classList.toggle("sidebar-open"); /* Move the main content */
     }

     function toggleSubmenu(element) {
         element.classList.toggle("open");
     }

     // Função para alternar a descrição dos cards
     function toggleCardDescription(cardId) {
         var cardDescription = document.getElementById('desc-' + cardId);
         var button = document.getElementById('btn-' + cardId);
         
         if (cardDescription.style.display === 'none') {
             cardDescription.style.display = 'block';
             button.innerText = 'Ver menos';
         } else {
             cardDescription.style.display = 'none';
             button.innerText = 'Ver mais';
         }
     }
 </script>
 

 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

 <br> <hr> <br>

 <!-- copyright -->
 <div class="cpy-right text-center">
   <p>© 2025 complexe scolaire multinacional. All rights reserved</p>
</div>
<!-- //copyright -->

</body>
</html>
