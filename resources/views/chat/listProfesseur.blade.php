<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../../img/books.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        tr {
            height: 40px;
        }

        tr:hover {
            background-color: #afc393;
            cursor: pointer;
            color: blue;
        }

        th {
            background-color: #1c359d;
            color: white;
        }

        .small-popup {
            font-size: 16px;
            padding: 20px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo"><img src="../../img/logo.png"></div>

    <div class="search">
        <input type="text" id="searchInput" placeholder="Pesquisar utilizador..." onkeyup="searchTable()">
    </div>
</div>

@include('partials.sidebargestchat')

<!-- CONTEÚDO -->
<div class="main-content">

<fieldset style="border-radius: 8px; border: 2px solid blue">
    <legend style="text-align: center;">
        <h3 style="color: blue;">LISTE USERS</h3>
    </legend>

@php
    $userFunction = Auth::user()->function;
    $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
    $loggedInUserId = Auth::id();
@endphp

<div class="container">

<table border="1" style="width: 100%; border-collapse: collapse;" id="usersTable">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Função</th>
            <th>Chat</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($users as $user)
        <tr>
            {{-- Nome (clicável para chat também) --}}
            <td align="center">
                    {{ $user->firstname }} {{ $user->lastname }}
            </td>

            <td align="center">{{ $user->function }}</td>

            {{-- CHAT --}}
            <td align="center">
                <a href="{{ route('chat.show', $user->id) }}">
                    <img src="../../img/chat4.png" style="width:30px;height:30px;">
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

<br>


</div>
</fieldset>
</div>

<!-- SCRIPTS -->
<script>
function confirmDelete(userId) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Essa ação não pode ser desfeita.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        customClass: { popup: 'small-popup' },
        width: '400px'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + userId).submit();
        }
    });
}

// PESQUISA
function searchTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.getElementById("usersTable");
    let tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            let text = td.textContent || td.innerText;
            tr[i].style.display = text.toLowerCase().includes(filter) ? "" : "none";
        }
    }
}

function toggleMenu() {
    document.getElementById("sidebar").classList.toggle("open");
}

function toggleSubmenu(el) {
    el.classList.toggle("open");
    let submenu = el.nextElementSibling;
    submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
}
</script>

</body>
</html>