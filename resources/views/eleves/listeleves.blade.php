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
        tr { height: 40px; }

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

<!-- Navbar -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo"><img src="../../img/logo.png"></div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebargestacad')

<div class="main-content">
<fieldset style="border-radius: 8px; border: 2px solid blue">

<legend style="text-align: center;">
    <h3 style="color: blue;">LISTE D'ELEVES</h3>
</legend>

<div class="container">
<div class="form-container">

@php
    $userFunction = Auth::user()->function;
    $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
@endphp


<!-- FILTRO POR CLASSE -->
<form method="GET" action="{{ route('eleves.listeleves') }}" style="margin-bottom: 15px;">

    <label><strong>Filtrar por Classe:</strong></label>

    <select name="classe_id" onchange="this.form.submit()">
        <option value="">-- Selecionar classe --</option>

        @foreach($classes as $classe)
            <option value="{{ $classe->id }}"
                {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                {{ $classe->code }}
            </option>
        @endforeach
    </select>

    <noscript>
        <button type="submit">Pesquisar</button>
    </noscript>

    <a href="{{ route('eleves.listeleves') }}" style="margin-left:10px;">
        Limpar
    </a>

</form>
<!-- FIM DO FILTRO -->


{{-- MOSTRAR TABELA SÓ SE ESCOLHER CLASSE --}}
@if(request()->filled('classe_id'))

<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Apelido</th>
            <th>Classe</th>
            <th colspan="3">ACTIONS</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($eleves as $eleve)
            <tr>
                <td align="center">{{ $eleve->matricula }}</td>
                <td align="center">{{ $eleve->nome }}</td>
                <td align="center">{{ $eleve->apelido }}</td>
                <td align="center">{{ $eleve->classe?->code ?? '-' }}</td>

                <td align="center">
                    <a href="{{ route('eleves.show', $eleve->id) }}">
                        <img src="../../img/det.png" style="width: 30px;">
                    </a>
                </td>

                @if ($isAdminOrDirection)
                    <td align="center">
                        <a href="{{ route('eleves.edit', $eleve->id) }}">
                            <img src="../../img/modif02.png" style="width: 30px;">
                        </a>
                    </td>
                @else
                    <td align="center">—</td>
                @endif

                @if ($isAdminOrDirection)
                    <td align="center">
                        <form id="delete-form-{{ $eleve->id }}"
                              action="{{ route('eleves.destroy', $eleve->id) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <button type="button"
                                onclick="confirmDelete({{ $eleve->id }})"
                                style="background:none;border:none;">
                            <img src="../../img/del0.png" style="width: 30px;">
                        </button>
                    </td>
                @else
                    <td align="center">—</td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="7" align="center">Nenhum aluno encontrado</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- BOTÃO EXPORTAR AGORA EM BAIXO -->
<div style="margin-top: 15px;">
    <form action="{{ route('eleves.export') }}" method="POST">
        @csrf
        <input type="hidden" name="classe_id" value="{{ request('classe_id') }}">
        <input type="submit" value="EXPORTER EM EXCEL">
    </form>
</div>
<!-- 🔼 FIM -->

@endif

</div>
</div>
</fieldset>
</div>

<!-- SweetAlert -->
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Essa ação não pode ser desfeita.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        width: '400px'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>


<!-- MENU SCRIPT -->
<script>

function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (!sidebar || !overlay) {
        console.error("Sidebar ou overlay não encontrados no DOM");
        return;
    }

    sidebar.classList.toggle("open");
    overlay.classList.toggle("active");
}


/* fechar ao clicar no overlay */
document.addEventListener("DOMContentLoaded", function () {

    const overlay = document.getElementById("overlay");
    const sidebar = document.getElementById("sidebar");

    if (overlay) {
        overlay.addEventListener("click", function () {
            sidebar.classList.remove("open");
            overlay.classList.remove("active");
        });
    }

});


function toggleSubmenu(element) {

    element.classList.toggle("open");

    const submenu = element.nextElementSibling;

    if (submenu) {
        submenu.style.display =
            submenu.style.display === "flex"
                ? "none"
                : "flex";
    }
}

</script>

</body>
</html>