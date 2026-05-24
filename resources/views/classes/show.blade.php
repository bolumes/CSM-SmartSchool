<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>
    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/books.png') }}">
    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #38a169;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
</head>
<body>

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

@include('partials.sidebargestacad')

<div class="main-content">
    <fieldset style="border-radius:8px; border:2px solid blue">
        <legend style="text-align:center">
            <h3 style="color:blue">DETAILS CLASSE</h3>
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
                <thead>
                    <tr>
                        <th>ATTRIBUT</th>
                        <th>VALEUR</th>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                         <td><strong>ID</strong></td>
                         <td>{{ $classe->id }}</td>
                     </tr>
                     <tr>
                         <td><strong>Nom</strong></td>
                         <td>{{ $classe->name }}</td>
                     </tr>
                     <tr>
                         <td><strong>Code</strong></td>
                         <td>{{ $classe->code }}</td>
                     </tr>
                     <tr>
                         <td><strong>Niveau</strong></td>
                         <td>{{ $classe->level }}</td>
                     </tr>
                     <tr>
                         <td><strong>Description</strong></td>
                         <td>{{ $classe->description }}</td>
                     </tr>
                     <tr>
                         <td><strong>Date de Création</strong></td>
                         <td>{{ $classe->created_at }}</td>
                     </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>

<script>
    function toggleMenu() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        if (sidebar) sidebar.classList.toggle("open");
        if (overlay) overlay.classList.toggle("active");
    }

    document.addEventListener("click", function(event) {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.querySelector(".menu-toggle");
        if (sidebar && toggleBtn && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("open");
            const overlay = document.getElementById("overlay");
            if (overlay) overlay.classList.remove("active");
        }
    });

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