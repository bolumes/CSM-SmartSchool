<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Assiduidade</title>

    <link rel="icon" href="{{ asset('img/books.png') }}">

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>

        .main-card{

            width:95%;
            max-width:1400px;

            margin:30px auto;

            background:#fff;

            padding:25px;

            border-radius:12px;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

        .page-title{

            color:#1c359d;

            font-size:28px;

            font-weight:bold;

            margin-bottom:25px;

        }

        .filter-area{

            display:grid;

            grid-template-columns:repeat(4,1fr);

            gap:20px;

            margin-bottom:25px;

        }

        .filter-box label{

            display:block;

            margin-bottom:8px;

            color:#1c359d;

            font-weight:bold;

        }

        .filter-box select,
        .filter-box input{

            width:100%;

            padding:12px;

            border:1px solid #ddd;

            border-radius:8px;

            outline:none;

        }

        .filter-box select:focus,
        .filter-box input:focus{

            border-color:#1c359d;

        }

        .statistics{

            display:grid;

            grid-template-columns:repeat(4,1fr);

            gap:20px;

            margin-bottom:25px;

        }

        .stat-card{

            background:#f8fafc;

            border-left:5px solid #1c359d;

            padding:20px;

            border-radius:10px;

            text-align:center;

        }

        .stat-card h2{

            margin:0;

            color:#1c359d;

        }

        .stat-card span{

            color:#555;

        }

        .action-buttons{

            display:flex;

            justify-content:space-between;

            margin-bottom:20px;

        }

        .btn{

            border:none;

            padding:10px 18px;

            border-radius:8px;

            cursor:pointer;

            color:#fff;

            text-decoration:none;

        }

        .btn-primary{

            background:#1c359d;

        }

        .btn-success{

            background:#16a34a;

        }

        .btn-danger{

            background:#dc2626;

        }

        .btn-warning{

            background:#eab308;

            color:#000;

        }

        .btn-info{

            background:#2563eb;

        }

        @media(max-width:900px){

            .filter-area{

                grid-template-columns:1fr;

            }

            .statistics{

                grid-template-columns:1fr;

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

<div class="main-content">

<div class="main-card">

<h2 class="page-title">

    <i class="fas fa-calendar-check"></i>

    Lista de Assiduidade

</h2>

<!-- FILTROS -->

<div class="filter-area">

    <div class="filter-box">

        <label>Nível</label>

        <select id="niveau">

            <option value="">Selecionar...</option>

            <option value="Maternelle">Maternelle</option>

            <option value="Elementaire">Elementaire</option>

            <option value="College">College</option>

            <option value="Lycee">Lycee</option>

        </select>

    </div>

    <div class="filter-box">

        <label>Turma</label>

        <select id="classe_id" disabled>

            <option>Escolha o nível</option>

        </select>

    </div>

    <div class="filter-box">

        <label>Data</label>

        <input type="date" id="attendance_date">

    </div>

    <div class="filter-box">

        <label>Estado</label>

        <select id="status">

            <option value="">Todos</option>

            <option value="present">Presentes</option>

            <option value="absent">Ausentes</option>

            <option value="late">Atrasados</option>

            <option value="justified">Justificadas</option>

        </select>

    </div>

</div>












<!-- ===========================
BOTÕES
=========================== -->

<div class="action-buttons">

    <div>

        <button class="btn btn-success" id="filterPresent">
            <i class="fas fa-user-check"></i>
            Presentes
        </button>

        <button class="btn btn-danger" id="filterAbsent">
            <i class="fas fa-user-times"></i>
            Ausentes
        </button>

        <button class="btn btn-warning" id="filterLate">
            <i class="fas fa-clock"></i>
            Atrasados
        </button>

        <button class="btn btn-info" id="filterJustified">
            <i class="fas fa-file-medical"></i>
            Justificadas
        </button>

    </div>

    <div>

        <a href="{{ route('attendance.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus-circle"></i>

            Nova Assiduidade

        </a>

    </div>

</div>


<!-- ===========================
ESTATÍSTICAS
=========================== -->

<div class="statistics">

    <div class="stat-card">

        <h2 id="totalAttendance">0</h2>

        <span>Total de Registos</span>

    </div>

    <div class="stat-card">

        <h2 id="totalPresent">0</h2>

        <span>Presentes</span>

    </div>

    <div class="stat-card">

        <h2 id="totalAbsent">0</h2>

        <span>Ausentes</span>

    </div>

    <div class="stat-card">

        <h2 id="totalLate">0</h2>

        <span>Atrasados</span>

    </div>

</div>


<!-- ===========================
TABELA
=========================== -->

<div style="overflow-x:auto;">

<table>

    <thead>

        <tr>

            <th>Data</th>

            <th>Aula</th>

            <th>Matrícula</th>

            <th>Aluno</th>

            <th>Turma</th>

            <th>Disciplina</th>

            <th>Professor</th>

            <th>Estado</th>

            <th>Observações</th>

            <th>Ações</th>

        </tr>

    </thead>

    <tbody id="table-body">

        <tr>

            <td colspan="10" class="message">

                Selecione um nível e uma turma.

            </td>

        </tr>

    </tbody>

</table>

</div>

</div>

</div>






<script>

/*=========================================================
    MENU LATERAL
=========================================================*/

function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (sidebar) sidebar.classList.toggle("open");
    if (overlay) overlay.classList.toggle("active");
}

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

const overlay = document.getElementById("overlay");

if (overlay) {

    overlay.addEventListener("click", function () {

        document
            .getElementById("sidebar")
            ?.classList.remove("open");

        overlay.classList.remove("active");

    });

}


/*=========================================================
    ELEMENTOS
=========================================================*/

const niveau = document.getElementById("niveau");
const classe = document.getElementById("classe_id");
const status = document.getElementById("status");
const attendanceDate = document.getElementById("attendance_date");

const tableBody = document.getElementById("table-body");

const totalAttendance = document.getElementById("totalAttendance");
const totalPresent = document.getElementById("totalPresent");
const totalAbsent = document.getElementById("totalAbsent");
const totalLate = document.getElementById("totalLate");

let attendanceData = [];


/*=========================================================
    NÍVEL -> CARREGAR TURMAS
=========================================================*/

if (niveau) {

    niveau.addEventListener("change", carregarClasses);

}

function carregarClasses() {

    let level = niveau.value;

    classe.disabled = true;

    classe.innerHTML =
        '<option>Carregando...</option>';

    tableBody.innerHTML = `
        <tr>
            <td colspan="9" class="message">
                Selecione uma turma.
            </td>
        </tr>
    `;

    if (!level) {

        classe.innerHTML =
            '<option>Escolha o nível</option>';

        return;
    }

    fetch("/attendance/classes-by-niveau/" + level)

    .then(response => response.json())

    .then(classes => {

        classe.innerHTML =
            '<option value="">Selecionar...</option>';

        if (classes.length === 0) {

            classe.innerHTML =
                '<option>Sem turmas</option>';

            return;
        }

        classes.forEach(item => {

            classe.innerHTML += `
                <option value="${item.id}">
                    ${item.code}
                </option>
            `;

        });

        classe.disabled = false;

    })

    .catch(() => {

        classe.innerHTML =
            '<option>Erro ao carregar</option>';

    });

}


/*=========================================================
    TURMA -> CARREGAR ASSIDUIDADE
=========================================================*/

if (classe) {

    classe.addEventListener("change", carregarAttendance);

}

function carregarAttendance() {

    let classeId = classe.value;

    if (!classeId) {

        tableBody.innerHTML = `
            <tr>
                <td colspan="9" class="message">
                    Escolha uma turma.
                </td>
            </tr>
        `;

        return;

    }

    tableBody.innerHTML = `
        <tr>
            <td colspan="9" class="message">
                Carregando...
            </td>
        </tr>
    `;

    fetch("/attendance/attendance-by-classe/" + classeId)

    .then(response => response.json())

    .then(data => {

        attendanceData = data;

        aplicarFiltros();

    })

    .catch(() => {

        tableBody.innerHTML = `
            <tr>
                <td colspan="9" class="message">
                    Erro ao carregar dados.
                </td>
            </tr>
        `;

    });

}


/*=========================================================
    FILTROS
=========================================================*/

if (status) {

    status.addEventListener("change", aplicarFiltros);

}

if (attendanceDate) {

    attendanceDate.addEventListener("change", aplicarFiltros);

}

function aplicarFiltros() {

    let lista = [...attendanceData];

    if (status.value) {

        lista = lista.filter(item => item.status === status.value);

    }

    if (attendanceDate.value) {

        lista = lista.filter(item =>
            item.attendance_date === attendanceDate.value
        );

    }

    desenharTabela(lista);

    atualizarEstatisticas(lista);

}


/*=========================================================
    DESENHAR TABELA
=========================================================*/

function desenharTabela(lista) {

    tableBody.innerHTML = "";

    if (lista.length === 0) {

        tableBody.innerHTML = `
            <tr>
                <td colspan="9" class="message">
                    Nenhum registo encontrado.
                </td>
            </tr>
        `;

        return;
    }

    lista.forEach(item => {

        let badge = "";

        switch (item.status) {

            case "present":
                badge = '<span class="badge bg-success">Presente</span>';
                break;

            case "absent":
                badge = '<span class="badge bg-danger">Ausente</span>';
                break;

            case "late":
                badge = '<span class="badge bg-warning">Atrasado</span>';
                break;

            default:
                badge = '<span class="badge bg-primary">Justificada</span>';
        }

        tableBody.innerHTML += `

        <tr>

            <td>${item.attendance_date}</td>

            <td>${item.lesson_number}</td>

            <td>${item.eleve?.nome ?? ''} ${item.eleve?.apelido ?? ''}</td>

            <td>${item.classe?.code ?? ''}</td>

            <td>${item.matiere?.name ?? ''}</td>

            <td>${item.professor?.firstname ?? ''} ${item.professor?.lastname ?? ''}</td>

            <td>${badge}</td>

            <td>${item.remarks ?? '-'}</td>

            <td>
                <a href="/attendance/${item.id}/edit">
                    <i class="fas fa-edit"></i>
                </a>
            </td>

        </tr>

        `;

    });

}


/*=========================================================
    ESTATÍSTICAS
=========================================================*/

function atualizarEstatisticas(lista) {

    totalAttendance.textContent = lista.length;

    totalPresent.textContent =
        lista.filter(i => i.status === "present").length;

    totalAbsent.textContent =
        lista.filter(i => i.status === "absent").length;

    totalLate.textContent =
        lista.filter(i => i.status === "late").length;

}


/*=========================================================
    BOTÕES RÁPIDOS
=========================================================*/

document.getElementById("filterPresent")?.addEventListener("click", () => {

    status.value = "present";
    aplicarFiltros();

});

document.getElementById("filterAbsent")?.addEventListener("click", () => {

    status.value = "absent";
    aplicarFiltros();

});

document.getElementById("filterLate")?.addEventListener("click", () => {

    status.value = "late";
    aplicarFiltros();

});

document.getElementById("filterJustified")?.addEventListener("click", () => {

    status.value = "justified";
    aplicarFiltros();

});

</script>