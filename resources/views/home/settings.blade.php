<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="icon" href="../../img/favicon.png">
</head>
<style>
      /* Estilo para a imagem */
.form-image img {
    height: 400px;         /* Altura fixa de 300px */
    margin-left: 90px;    /* Margem à esquerda para centralização */
    max-width: 100%;       /* A imagem não ultrapassará a largura do contêiner */
    width: 700px;           /* Mantém a proporção da imagem */
}

/* Responsividade: ajustar em telas menores */
@media (max-width: 768px) {
    .form-image img {
        margin-left: 0;     /* Remove a margem à esquerda em telas menores */
        height: auto;       /* A altura será ajustada automaticamente */
        width: 100%;        /* Faz com que a imagem ocupe toda a largura da tela */
    }
}

@media (max-width: 480px) {
    .form-image img {
        height: 200px;      /* Ajusta a altura para telas muito pequenas */
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
        <div class="icons">
            <div class="icon" title="Notificações">🔔</div>
            <div class="icon" title="Perfil">👤</div>
            <div class="icon" title="Sair">🔓</div>
        </div>
    </div>

    <!--partials sidebar-->
   @include('partials.sidebar1')
  

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">S E T T I N G S</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">
            <!-- Seção da Imagem -->
            <div class="form-image">
              <img src="../../img/Saladeaula_itapevi.jpg" alt="Imagem do Formulário">
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
