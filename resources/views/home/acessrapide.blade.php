<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="icon" href="../../img/books.png">

    <style>
      .form-image {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 colunas */
    grid-template-rows: repeat(2, auto);   /* 2 linhas */

    gap: 8px;

    width: 100%;
    max-width: 1000px;
    padding: 10px;
    box-sizing: border-box;
}

/* IMAGENS */
.form-image img {
    width: 100%;
    height: auto;
    max-height: 180px;
    object-fit: contain;

    border-radius: 12px;
    transition: 0.2s ease;
    cursor: pointer;
}

/* hover moderno */
.form-image img:hover {
    transform: scale(1.05);
}

/* RESPONSIVO */
@media (max-width: 900px) {
    .form-image {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .form-image {
        grid-template-columns: 1fr;
    }

    .form-image img {
        max-height: 180px;
    }
}
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo">
            <img src="../../img/logo.png">
        </div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

    <!-- SIDEBAR -->
    @include('partials.sidebarwelcome')

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="main-content">

        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">{{ __('messages.QuickAccess') }}</h3></legend>

            <div class="container">
                <div class="form-image">

                    <a href="{{ route('home.gestacad') }}"><img src="../../img/acad.png" alt="Gestão Académica"></a>

                    <a href="{{ route('home.gesteventos') }}"><img src="../../img/ge.png" alt="Gestão Eventos"></a>

                    <a href="{{ route('home.gestchat') }}"><img src="../../img/chat.png" alt="Gestão Chat"></a>

                    <a href="{{ route('anuncios.listanuncios') }}"><img src="../../img/anu.png" alt="Gestão Chat"></a>

                    <img src="../../img/par.png" alt="Parâmetros">

                    <img src="../../img/chat3.png" alt="Gestão Eventos">

                </div>
            </div>

        </fieldset>

    </div>

    <!-- SCRIPTS -->
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