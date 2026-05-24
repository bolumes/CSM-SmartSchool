<!DOCTYPE html>
<html lang="pt-PT">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CSM-SmartSchool</title>

<link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="icon" href="{{ asset('img/books.png') }}">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">

    <div class="menu-toggle" onclick="toggleMenu()">
        ☰
    </div>

    <div class="logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>

    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>

</div>

@include('partials.sidebarsettings')

<div class="main-content">

<fieldset style="border-radius:8px; border:2px solid blue">
<legend style="text-align:center">
<h3 style="color:blue">DETAILS USER</h3>
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
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td><strong>Nom</strong></td>
            <td>{{ $user->firstname }}</td>
        </tr>
        <tr>
            <td><strong>Prénom</strong></td>
            <td>{{ $user->lastname }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><strong>Téléphone</strong></td>
            <td>{{ $user->telephone }}</td>
        </tr>
        <tr>
            <td><strong>Adresse</strong></td>
            <td>{{ $user->address }}</td>
        </tr>
        <tr>
            <td><strong>Fonction</strong></td>
            <td>{{ $user->function }}</td>
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            <td>{{ $user->description }}</td>
        </tr>
        <tr>
            <td><strong>Date de Création</strong></td>
            <td>{{ $user->created_at }}</td>
        </tr>
    </tbody>
</table>

</div>
</div>
</fieldset>

</div>

<script>

/* Sidebar Toggle */
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("open");
}

/* Click outside sidebar = close */
document.addEventListener("click", function(event){

    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".menu-toggle");

    if(!sidebar.contains(event.target) &&
       !toggleBtn.contains(event.target)){
        sidebar.classList.remove("open");
    }
});

/* Submenu toggle */
function toggleSubmenu(element){
    event.preventDefault();

    const submenu = element.nextElementSibling;

    if(submenu){
        submenu.style.display =
            submenu.style.display === "flex" ? "none" : "flex";
    }
}

</script>

</body>
</html>