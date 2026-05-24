<!DOCTYPE html>
<html lang="pt-PT">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Bulletin de Notes</title>

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/style1.css') }}">

    <!-- ICON -->
    <link rel="icon"
          href="{{ asset('img/books.png') }}">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          rel="stylesheet">

    <style>

        .bulletin-container{
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .title{
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #1c359d;
        }

        .student-header{
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            background: #f8fafc;
            padding: 18px;
            border-radius: 10px;
            border-left: 5px solid #1c359d;
        }

        .student-info{
            line-height: 40px;
            font-size: 18px;
        }

        .student-info strong{
            color: #1c359d;
        }

        .trimester-card{
            margin-top: 35px;
            border: 2px solid #dbeafe;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .trimester-header{
            background: #1c359d;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            font-weight: bold;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: #dbeafe;
            color: #1e3a8a;
            border: 1px solid #cbd5e1;
            padding: 14px;
            text-align: center;
            font-size: 18px;
        }

        td{
            border: 1px solid #e2e8f0;
            padding: 14px;
            font-size: 17px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #f8fafc;
        }

        tr:hover{
            background: #eef2ff;
            transition: 0.3s;
        }

        .success{
            color: green;
            font-weight: bold;
        }

        .danger{
            color: red;
            font-weight: bold;
        }

        .moyenne-box{
            margin-top: 20px;
            background: #eff6ff;
            border-left: 5px solid #2563eb;
            padding: 15px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .btn-area{
            margin-top: 35px;
        }

        .btn-back{
            background: #1c359d;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn-back:hover{
            background: #16297a;
        }

        .btn-export{
            background: #16a34a;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-export:hover{
            background: #15803d;
        }

        .empty-message{
            padding: 20px;
            text-align: center;
            font-size: 18px;
            color: #64748b;
        }

        @media(max-width:768px){

            .student-header{
                flex-direction: column;
            }

            .student-info{
                font-size: 16px;
                line-height: 35px;
            }

            th, td{
                font-size: 14px;
                padding: 10px;
            }

            .trimester-header{
                font-size: 18px;
            }

            .moyenne-box{
                font-size: 18px;
            }
        }

    </style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">

    <div class="menu-toggle"
         onclick="toggleMenu()">
         ☰
    </div>

    <div class="logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>

</div>

@include('partials.sidebargestacad')

<!-- MAIN -->
<div class="main-content">

    <div class="bulletin-container">

        <!-- TITLE -->
        <h3 class="title">
            <i class="fas fa-file-alt"></i>
            Bulletin de Notes
        </h3>

        <!-- HEADER -->
        <div class="student-header">

            <!-- LEFT -->
            <div class="student-info">

                <div>
                    <strong>Matricule:</strong>
                    {{ $eleve->matricula }}
                </div>

                <div>
                    <strong>Nome:</strong>
                    {{ $eleve->nome }}
                    {{ $eleve->apelido }}
                </div>

                <div>
                    <strong>Classe:</strong>
                    {{ $eleve->classe->code ?? '-' }}
                </div>

            </div>

            <!-- RIGHT -->
            <div class="student-info">

                <div>
                    <strong>Ano Lectivo:</strong>
                    {{ $eleve->notes->first()->ano_letivo ?? '-' }}
                </div>

                <div>
                    <strong>Total de Notes:</strong>
                    {{ $eleve->notes->count() }}
                </div>

                <div>

                    <strong>MG:</strong>

                    @php

                        $mg =
                        $eleve->notes->avg('nota');

                    @endphp

                    {{ number_format($mg, 2) }}

                </div>

            </div>

        </div>

        <!-- TRIMESTRES -->
        @forelse($trimestres as $trimestre => $matieres)

            <div class="trimester-card">

                <!-- HEADER TRIMESTRE -->
                <div class="trimester-header">

                    {{ $trimestre }}º Trimestre

                </div>

                <!-- TABLE -->
                <table>

                    <thead>

                        <tr>
                            <th>Matière</th>
                            <th>Note</th>
                            <th>Moyenne</th>
                            <th>Observation</th>
                        </tr>

                    </thead>

                    <tbody>

                    @php
                        $mediaGeral = 0;
                        $contador = 0;
                    @endphp

                    @foreach($matieres as $item)

                        @php

                            $media =
                            $item['notes']->avg('nota');

                            $mediaGeral += $media;

                            $contador++;

                        @endphp

                        <tr>

                            <!-- MATIERE -->
                            <td>

                                {{ $item['matiere']->name ?? '-' }}

                            </td>

                            <!-- NOTES -->
                            <td>

                                @foreach($item['notes'] as $note)

                                    <span>

                                        {{ $note->nota }}

                                    </span>

                                    @if(!$loop->last)
                                        ,
                                    @endif

                                @endforeach

                            </td>

                            <!-- MOYENNE -->
                            <td>

                                <strong>

                                    {{ number_format($media, 2) }}

                                </strong>

                            </td>

                            <!-- OBS -->
                            <td>

                                @if($media >= 10)

                                    <span class="success">
                                        Validé
                                    </span>

                                @else

                                    <span class="danger">
                                        Échec
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

                <!-- MOYENNE GENERALE -->
                <div class="moyenne-box">

                    Moyenne du
                    {{ $trimestre }}º Trimestre :

                    {{ $contador > 0
                        ? number_format($mediaGeral / $contador, 2)
                        : '0.00'
                    }}

                </div>

            </div>

        @empty

            <div class="empty-message">

                Nenhuma nota encontrada.

            </div>

        @endforelse

        <!-- BUTTONS -->
        <div class="btn-area">

            <a href="{{ route('notes.listenotes') }}"
               class="btn-back">

                ← Voltar

            </a>

            <a href="{{ route('eleves.exportBoletim', $eleve->id) }}"
               class="btn-export">

                ⬇ Exportar Excel

            </a>

        </div>

    </div>

</div>

<script>

/* =========================
   MENU SIDEBAR
========================= */
function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    /* ABRIR / FECHAR MENU */
    sidebar.classList.toggle("open");

    /* OVERLAY */
    if (overlay) {
        overlay.classList.toggle("active");
    }
}


/* =========================
   SUBMENU
========================= */
function toggleSubmenu(element){

    element.classList.toggle("open");

    const submenu =
    element.nextElementSibling;

    if (submenu) {

        submenu.style.display =
        submenu.style.display === "flex"
        ? "none"
        : "flex";
    }
}


/* =========================
   FECHAR MENU AO CLICAR FORA
========================= */
const overlay = document.getElementById("overlay");

if (overlay) {

    overlay.addEventListener("click", function(){

        document
        .getElementById("sidebar")
        .classList.remove("open");

        overlay.classList.remove("active");
    });
}

</script>

</body>
</html>