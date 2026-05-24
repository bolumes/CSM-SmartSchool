<!DOCTYPE html>
<html lang="pt-PT">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Editar Notas</title>

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

        /* =========================
           FIX SIDEBAR
        ========================= */

        #sidebar{
            position: fixed;
            z-index: 9999;
        }

        .navbar{
            position: relative;
            z-index: 10000;
        }

        .main-content{
            position: relative;
            z-index: 1;
        }

        /* =========================
           CONTAINER
        ========================= */

        .edit-container{
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .title{
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #1c359d;
        }

        /* =========================
           STUDENT HEADER
        ========================= */

        .student-header{
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #1c359d;
        }

        .student-info{
            line-height: 40px;
            font-size: 17px;
        }

        .student-info strong{
            color: #1c359d;
        }

        /* =========================
           TRIMESTRE CARD
        ========================= */

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

        /* =========================
           TABLE
        ========================= */

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
            font-size: 17px;
        }

        td{
            border: 1px solid #e2e8f0;
            padding: 14px;
            font-size: 16px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #f8fafc;
        }

        tr:hover{
            background: #eef2ff;
            transition: 0.3s;
        }

        /* =========================
           INPUT NOTE
        ========================= */

        .note-input{
            width: 90px;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            text-align: center;
            outline: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .note-input:focus{
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
        }

        /* =========================
           BADGE
        ========================= */

        .badge{
            background: #dbeafe;
            color: #1e3a8a;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        /* =========================
           BUTTONS
        ========================= */

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
            transition: 0.3s;
        }

        .btn-back:hover{
            background: #16297a;
        }

        .btn-save{
            background: #16a34a;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-save:hover{
            background: #15803d;
        }

        /* =========================
           EMPTY
        ========================= */

        .empty-message{
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 18px;
            font-weight: bold;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width:768px){

            .student-header{
                flex-direction: column;
            }

            .student-info{
                font-size: 15px;
                line-height: 34px;
            }

            th, td{
                font-size: 13px;
                padding: 10px;
            }

            .trimester-header{
                font-size: 17px;
            }

            .note-input{
                width: 70px;
                font-size: 13px;
            }

            .title{
                font-size: 21px;
            }

            .btn-save,
            .btn-back{
                display: inline-block;
                margin-top: 10px;
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

    <div class="edit-container">

        <!-- TITLE -->
        <h3 class="title">
            <i class="fas fa-edit"></i>
            Editar Bulletin de Notes
        </h3>

        <!-- STUDENT HEADER -->
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

                    <span class="badge">
                        {{ $eleve->classe->code ?? '-' }}
                    </span>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="student-info">

                <div>
                    <strong>Total de Notes:</strong>
                    {{ $eleve->notes->count() }}
                </div>

                <div>

                    <strong>MG:</strong>

                    @php
                        $mg = $eleve->notes->avg('nota');
                    @endphp

                    {{ number_format($mg, 2) }}

                </div>

            </div>

        </div>

        <!-- FORM -->
        <form method="POST"
              action="/eleves/{{ $eleve->id }}/notes/update">

            @csrf

            @forelse($notesByTrimestre ?? [] as $trimestre => $notes)

                <div class="trimester-card">

                    <!-- HEADER -->
                    <div class="trimester-header">

                        {{ $trimestre }}º Trimestre

                    </div>

                    <!-- TABLE -->
                    <table>

                        <thead>

                            <tr>
                                <th>Matière</th>
                                <th>Nota</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($notes ?? [] as $note)

                                <tr>

                                    <!-- MATIERE -->
                                    <td>

                                        <strong>
                                            {{ $note->matiere->name ?? '-' }}
                                        </strong>

                                    </td>

                                    <!-- NOTE -->
                                    <td>

                                        <input type="number"
                                               class="note-input"
                                               name="notes[{{ $note->id }}]"
                                               value="{{ $note->nota }}"
                                               step="0.1"
                                               min="0"
                                               max="20">

                                    </td>

                                    <!-- STATUS -->
                                    <td>

                                        @if($note->nota >= 10)

                                            <span style="color:green; font-weight:bold;">
                                                ✔ Validé
                                            </span>

                                        @else

                                            <span style="color:red; font-weight:bold;">
                                                ✖ Échec
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

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

                <button type="submit"
                        class="btn-save">

                    💾 Guardar Alterações

                </button>

            </div>

        </form>

    </div>

</div>

<script>

/* =========================
   MENU SIDEBAR
========================= */
function toggleMenu() {

    const sidebar =
    document.getElementById("sidebar");

    const overlay =
    document.getElementById("overlay");

    sidebar.classList.toggle("open");

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

    if(submenu){

        submenu.style.display =
        submenu.style.display === "flex"
        ? "none"
        : "flex";
    }
}


/* =========================
   CLOSE MENU
========================= */
const overlay =
document.getElementById("overlay");

if (overlay) {

    overlay.addEventListener("click", function(){

        document
        .getElementById("sidebar")
        .classList.remove("open");

        overlay.classList.remove("active");
    });
}
s
</script>

</body>
</html>