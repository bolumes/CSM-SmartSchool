<!DOCTYPE html>
<html lang="pt-PT">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Alunos por Classe</title>

    <!-- ICON -->
    <link rel="icon" href="{{ asset('img/books.png') }}">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">

    <style>

        tr{
            height: 45px;
        }

        tr:hover{
            background-color: #eef2ff;
            transition: 0.3s;
        }

        th{
            background-color: #1c359d;
            color: white;
        }

        .card-container{
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .page-title{
            color: #1c359d;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .filter-box{
            margin-bottom: 20px;
        }

        .filter-box label{
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #1c359d;
        }

        .filter-box select{
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            outline: none;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td{
            padding: 14px;
            text-align: center;
            border: 1px solid #edf2f7;
        }

        tr:nth-child(even){
            background: #f8fafc;
        }

        .btn{
            padding: 8px 14px;
            background: #1c359d;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            transition: 0.3s;
            display: inline-block;
        }

        .btn:hover{
            background: #16297a;
        }

        .badge{
            background: #dbeafe;
            color: #1e3a8a;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .message{
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-weight: bold;
        }

        .clear-btn{
            display: inline-block;
            margin-top: 10px;
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .clear-btn:hover{
            text-decoration: underline;
        }

        @media(max-width:768px){

            table{
                font-size: 12px;
            }

            th, td{
                padding: 10px;
            }

            .btn{
                font-size: 11px;
                padding: 6px 10px;
            }
        }

    </style>

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

@include('partials.sidebargestacad')

<!-- MAIN -->
<div class="main-content">

    <div class="card-container">

        <!-- TITLE -->
        <h2 class="page-title">
            <i class="fas fa-user-graduate"></i>
            Lista de Alunos por Classe
        </h2>

        <!-- FILTER -->
        <div class="filter-box">

            <label>
                <i class="fas fa-school"></i>
                Selecionar Classe
            </label>

            <select id="classe_id">

                <option value="">
                    -- Escolher Classe --
                </option>

                @foreach($classes as $classe)

                    <option value="{{ $classe->id }}">
                        {{ $classe->code }}
                    </option>

                @endforeach

            </select>

            <!-- BOTÃO LIMPAR -->
            <a href="#" id="clearFilter" class="clear-btn">
                Limpar
            </a>

        </div>

        <!-- TABLE -->
        <table>

            <thead>

                <tr>
                    <th>Matricule</th>
                    <th>Nom Complet</th>
                    <th>Classe</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody id="table-body">

                <tr>
                    <td colspan="4" class="message">
                        Escolha uma classe para listar os alunos.
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<script>

/* =========================
   MENU SIDEBAR
========================= */
function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    /* ABRIR / FECHAR SIDEBAR */
    sidebar.classList.toggle("open");

    /* OVERLAY */
    if (overlay) {
        overlay.classList.toggle("active");
    }
}


/* =========================
   SUBMENU
========================= */
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


/* =========================
   FECHAR MENU AO CLICAR OVERLAY
========================= */
const overlay = document.getElementById("overlay");

if (overlay) {

    overlay.addEventListener("click", function () {

        document
            .getElementById("sidebar")
            .classList.remove("open");

        overlay.classList.remove("active");
    });
}


/* =========================
   LIMPAR FILTRO
========================= */
document.getElementById('clearFilter')
.addEventListener('click', function(e){

    e.preventDefault();

    document.getElementById('classe_id').value = '';

    document.getElementById('table-body').innerHTML = `

        <tr>
            <td colspan="4" class="message">
                Escolha uma classe para listar os alunos.
            </td>
        </tr>

    `;
});


/* =========================
   FILTRAR ALUNOS
========================= */
document.getElementById('classe_id')
.addEventListener('change', function () {

    let classeId = this.value;

    let tableBody =
    document.getElementById('table-body');

    /* LOADING */
    tableBody.innerHTML = `
        <tr>
            <td colspan="4" class="message">
                ⏳ Carregando alunos...
            </td>
        </tr>
    `;

    /* SEM CLASSE */
    if (!classeId) {

        tableBody.innerHTML = `
            <tr>
                <td colspan="4" class="message">
                    Escolha uma classe.
                </td>
            </tr>
        `;

        return;
    }

    /* FETCH */
    fetch('/eleves-by-classe/' + classeId)

    .then(response => response.json())

    .then(data => {

        console.log(data);

        tableBody.innerHTML = '';

        /* VAZIO */
        if (data.length === 0) {

            tableBody.innerHTML = `
                <tr>
                    <td colspan="4" class="message">
                        Nenhum aluno encontrado.
                    </td>
                </tr>
            `;

            return;
        }

        /* LOOP */
        data.forEach(eleve => {

            tableBody.innerHTML += `

                <tr>

                    <!-- MATRICULA -->
                    <td align="center">

                        <strong>
                            ${eleve.matricula ?? '-'}
                        </strong>

                    </td>

                    <!-- NOME -->
                    <td align="center">

                        <i class="fas fa-user-graduate"></i>

                        ${eleve.nome ?? ''}

                        ${eleve.apelido ?? ''}

                    </td>

                    <!-- CLASSE -->
                    <td align="center">

                        <span class="badge">

                            ${eleve.classe?.code ?? '-'}

                        </span>

                    </td>

                    <!-- ACTION -->
                    <td align="center">

                        <a class="btn"
                        href="/eleves/${eleve.id}/notes">

                            <i class="fas fa-chart-bar"></i>
                            Ver Boletim

                        </a>

                        <a class="btn"
                            style="background:#16a34a; margin-left:5px;"
                            href="/eleves/${eleve.id}/notes/edit">

                                <i class="fas fa-edit"></i>
                                Editar
                        </a>

                    </td>

                </tr>

            `;
        });

    })

    .catch(error => {

        console.log(error);

        tableBody.innerHTML = `
            <tr>
                <td colspan="4" class="message">
                    ❌ Erro ao carregar alunos.
                </td>
            </tr>
        `;
    });

});

</script>

</body>
</html>