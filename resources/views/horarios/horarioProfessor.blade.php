<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../../img/books.png">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#f4f7fc;
            font-family: Arial, Helvetica, sans-serif;
        }

        #overlay{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.35);
            display:none;
            z-index:998;
        }

        #overlay.active{
            display:block;
        }

        #sidebar{
            z-index:999;
            position:fixed;
        }

        .schedule-card{
            background:white;
            border-radius:15px;
            padding:25px;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
            margin-top:20px;
        }

        .header-top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
            flex-wrap:wrap;
            gap:15px;
        }

        .title{
            color:#1c359d;
            font-size:28px;
            font-weight:bold;
        }

        .subtitle{
            color:gray;
            margin-top:5px;
        }

        .btn{
            padding:10px 18px;
            border-radius:8px;
            text-decoration:none;
            color:white;
            font-size:14px;
            transition:0.3s;
            border:none;
        }

        .btn-primary{ background:#1c359d; }
        .btn-primary:hover{ background:#142772; }

        .btn-danger{ background:#dc3545; }
        .btn-danger:hover{ background:#b02a37; }

        .table-container{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        th{
            background:#1c359d;
            color:white;
            padding:14px;
            font-size:15px;
        }

        td{
            padding:12px;
            border-bottom:1px solid #eee;
            text-align:center;
            font-size:14px;
        }

        tr:hover{
            background:#f0f4ff;
        }

        .professor-name{
            font-weight:bold;
            color:#1c359d;
        }

        .empty-row{
            color:gray;
            font-style:italic;
        }

        @media(max-width:768px){
            .header-top{
                flex-direction:column;
                align-items:flex-start;
            }

            .title{ font-size:22px; }
            table{ font-size:13px; }
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
        <input
            type="text"
            id="searchInput"
            placeholder="Pesquisar professor..."
            onkeyup="searchProfessor()"
        >
    </div>
</div>

<!-- OVERLAY -->
<div id="overlay" onclick="toggleMenu()"></div>

<!-- SIDEBAR -->
@include('partials.sidebargesteventos')

<!-- MAIN -->
<div class="main-content">

    <div class="schedule-card">

        <div class="header-top">

            <div>
                <h1 class="title">
                    <i class="fas fa-calendar-alt"></i>
                    Horário dos Professores
                </h1>

                <p class="subtitle">
                    Gestão completa dos horários escolares
                </p>
            </div>

            <div>
                <a href="{{ route('horarios.downloadAll') }}" class="btn btn-danger">
                    <i class="fas fa-download"></i>
                    Download All
                </a>
            </div>

        </div>

        <!-- TABLE -->
        <div class="table-container">

            <table id="scheduleTable">

                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Matière</th>
                        <th>Sala</th>
                        <th>Data</th>
                        <th>Início/Fim</th>
                        <th>Download</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($professors as $professor)

                    @php $hasEvents = false; @endphp

                    @foreach($professor->events as $event)

                        @foreach($event->progevents as $prog)

                            @php $hasEvents = true; @endphp

                            <tr>
                                <td class="professor-name">
                                    {{ $professor->firstname }} {{ $professor->lastname }}
                                </td>

                                <td>{{ $event->matiere->code ?? '-' }}</td>
                                <td>{{ $prog->sala->name ?? '-' }}</td>
                                <td>{{ $prog->date }}</td>

                                <!-- ✔ ALTERAÇÃO AQUI -->
                                <td>
                                    {{ $prog->start }} - {{ $prog->end }}
                                </td>

                                <td>
                                    <a href="{{ route('horarios.download', $professor->id) }}"
                                       class="btn btn-primary">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                    @endforeach

                    @if(!$hasEvents)

                        <tr>
                            <td class="professor-name">
                                {{ $professor->firstname }} {{ $professor->lastname }}
                            </td>

                            <td colspan="3" class="empty-row">
                                Nenhum horário disponível
                            </td>

                            <td>-</td>

                            <td>
                                <a href="{{ route('horarios.download', $professor->id) }}"
                                   class="btn btn-primary">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>

                    @endif

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

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

    if(submenu){
        submenu.classList.toggle("open");
    }
}

function searchProfessor() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("#scheduleTable tbody tr");

    rows.forEach(row => {
        let professor = row.cells[0].innerText.toLowerCase();
        row.style.display = professor.includes(input) ? "" : "none";
    });
}

</script>

</body>
</html>