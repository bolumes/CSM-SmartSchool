<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="icon" href="../../img/books.png">
</head>
<style>
        /* Container da imagem */
        .form-image {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Imagem responsiva */
        .form-image img {
            width: 100%;
            max-width: 500px; /* limite máximo */
            height: auto; /* mantém proporção */
            object-fit: contain; /* evita deformação */
            display: block;
        }

        /* Tablets */
        @media (max-width: 768px) {
            .form-image img {
                max-width: 90%;
            }
        }

        /* Telemóveis */
        @media (max-width: 480px) {
            .form-image img {
                max-width: 95%;
            }
        }

</style>
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
   @include('partials.sidebargestchat')
  

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">GESTION CHAT</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
              <img src="../../img/gestchat1.png" alt="Imagem do Formulário">
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
