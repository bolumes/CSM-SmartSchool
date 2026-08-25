<!DOCTYPE html>
<html lang="pt-PT">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">

    <link rel="icon" href="{{ asset('img/books.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>

.permission-table input,
.permission-table select,
.permission-table textarea{

    width:100%;
    padding:8px 10px;
    border:1px solid #ccc;
    border-radius:4px;
    box-sizing:border-box;
    font-size:14px;

}

.permission-table textarea{

    resize:vertical;

}

.permission-table label{

    font-weight:normal;

}

.btn-group-center{

    text-align:center;
    margin-top:10px;

}

.action-btn{

    padding:8px 20px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    margin:0 10px;
    transition:.3s;

}

.btn-cancel{

    background:#6c757d;
    color:white;

}

.btn-submit{

    background:#1c359d;
    color:white;

}

.btn-cancel:hover{

    background:#555;

}

.btn-submit:hover{

    background:#142b82;

}

.error-messages{

    background:#f8d7da;
    color:#721c24;
    padding:15px;
    border-radius:6px;
    margin-bottom:15px;
    border:1px solid #f5c6cb;

}

.error-messages ul{

    margin:0;
    padding-left:20px;

}

.toast{

    position:fixed;
    top:20px;
    right:20px;
    background:#38a169;
    color:white;
    padding:15px 25px;
    border-radius:8px;
    box-shadow:0 5px 15px rgba(0,0,0,.2);
    z-index:9999;
    animation:slideIn .5s, fadeOut .5s 3.5s forwards;

}

@keyframes slideIn{

from{

opacity:0;
transform:translateY(-20px);

}

to{

opacity:1;
transform:translateY(0);

}

}

@keyframes fadeOut{

to{

opacity:0;
transform:translateY(-20px);

}

}

</style>

</head>

<body>

<div id="overlay" class="overlay"></div>

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

@include('partials.sidebargestacad')

<div class="main-content">

<fieldset style="border-radius:8px;border:2px solid blue;">

<legend style="text-align:center">

<h3 style="color:blue;">

EDITER SALLE

</h3>

</legend>

<div class="container">

<div style="text-align:center;">

<img src="{{ asset('img/modif01.png') }}" style="height:50px;">

</div>

@if(session('success'))

<div class="toast">

{{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="error-messages">

<ul>

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('salas.update',$sala->id) }}" method="POST">

@csrf

@method('PUT')

<table class="permission-table">

<thead>

<tr>

<th>ATTRIBUT</th>

<th>VALEUR</th>

</tr>

</thead>

<tbody>

<tr>
    <td><strong>Nom</strong></td>
    <td>
        <input
            type="text"
            name="name"
            value="{{ old('name', $sala->name) }}"
            required>
    </td>
</tr>

<tr>
    <td><strong>Réserver</strong></td>
    <td>

        <select name="reservar" required>

            <option value="">Sélectionner</option>

            <option value="Sim"
                {{ old('reservar',$sala->reservar)=='Sim' ? 'selected' : '' }}>
                Oui
            </option>

            <option value="Nao"
                {{ old('reservar',$sala->reservar)=='Nao' ? 'selected' : '' }}>
                Non
            </option>

        </select>

    </td>
</tr>

<tr>

    <td><strong>Catégorie</strong></td>

    <td>

        <select name="categoria" required>

            <option value="">Sélectionner</option>

            <option value="Cours"
            {{ old('categoria',$sala->categoria)=='Cours' ? 'selected':'' }}>
                Cours
            </option>

            <option value="Seminaire"
            {{ old('categoria',$sala->categoria)=='Seminaire' ? 'selected':'' }}>
                Séminaire
            </option>

            <option value="Workshop"
            {{ old('categoria',$sala->categoria)=='Workshop' ? 'selected':'' }}>
                Workshop
            </option>

            <option value="Autres"
            {{ old('categoria',$sala->categoria)=='Autres' ? 'selected':'' }}>
                Autres
            </option>

        </select>

    </td>

</tr>

<tr>

    <td><strong>Capacité</strong></td>

    <td>

        <input
            type="number"
            name="capacidade"
            value="{{ old('capacidade',$sala->capacidade) }}"
            required>

    </td>

</tr>

<tr>

    <td><strong>Édifice</strong></td>

    <td>

        <select
            name="edificio_id"
            required>

            <option value="">
                Sélectionner
            </option>

            @foreach($edificios as $edificio)

                <option
                    value="{{ $edificio->id }}"
                    {{ old('edificio_id',$sala->edificio_id)==$edificio->id ? 'selected':'' }}>

                    {{ $edificio->name }}

                </option>

            @endforeach

        </select>

    </td>

</tr>

<tr>

    <td><strong>Caractéristiques</strong></td>

    <td>

        <textarea
            name="caracteristicas"
            rows="5">{{ old('caracteristicas',$sala->caracteristicas) }}</textarea>

    </td>

</tr>

<tr>

    <td><strong>Localisation</strong></td>

    <td>

        <input
            type="text"
            name="localizacao"
            value="{{ old('localizacao',$sala->localizacao) }}">

    </td>

</tr>

<tr>

    <td><strong>Image</strong></td>

    <td>

        <input
            type="text"
            name="imagem"
            value="{{ old('imagem',$sala->imagem) }}">

    </td>

</tr>

<tr>

    <td colspan="2">

        <div class="btn-group-center">

            <button
                type="reset"
                class="action-btn btn-cancel">

                Annuler

            </button>

            <button
                type="submit"
                class="action-btn btn-submit">

                Actualiser

            </button>

        </div>

    </td>

</tr>

</tbody>

</table>

</form>

</div>

</fieldset>

</div>

<script>

function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (sidebar) {
        sidebar.classList.toggle("open");
    }

    if (overlay) {
        overlay.classList.toggle("active");
    }

}

/*==================================
FECHAR MENU AO CLICAR FORA
===================================*/

document.addEventListener("click", function(event) {

    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".menu-toggle");

    if (
        sidebar &&
        toggleBtn &&
        !sidebar.contains(event.target) &&
        !toggleBtn.contains(event.target)
    ) {

        sidebar.classList.remove("open");

        const overlay = document.getElementById("overlay");

        if (overlay) {

            overlay.classList.remove("active");

        }

    }

});

/*==================================
SUBMENU
===================================*/

function toggleSubmenu(element, event) {

    if (event) {

        event.preventDefault();

    }

    element.classList.toggle("open");

    const submenu = element.nextElementSibling;

    if (submenu) {

        submenu.style.display =
            submenu.style.display === "flex"
                ? "none"
                : "flex";

        if (submenu.style.display === "flex") {

            submenu.style.flexDirection = "column";

        }

    }

}

/*==================================
TOAST
===================================*/

setTimeout(function(){

    const toast = document.querySelector(".toast");

    if(toast){

        toast.style.display = "none";

    }

},4000);

</script>

</body>
</html>