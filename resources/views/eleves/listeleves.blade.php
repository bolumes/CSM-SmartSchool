
<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    >

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>CSM-SmartSchool</title>

    <link
        rel="stylesheet"
        href="../css/style1.css"
    >

    <link
        rel="icon"
        href="../../img/books.png"
    >

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

        .export-button {
            background-color: #198754;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        .export-button:hover {
            background-color: #146c43;
        }

    </style>

</head>


<body>


<!-- =========================================================
     NAVBAR
========================================================= -->

<div class="navbar">

    <div
        class="menu-toggle"
        onclick="toggleMenu()"
    >
        ☰
    </div>

    <div class="logo">

        <img
            src="../../img/logo.png"
        >

    </div>

    <div class="search">

        <input
            type="text"
            placeholder="Pesquisar..."
        >

    </div>

</div>


<!-- =========================================================
     SIDEBAR
========================================================= -->

@include('partials.sidebargestacad')


<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<div class="main-content">

    <fieldset
        style="
            border-radius: 8px;
            border: 2px solid blue;
        "
    >

        <legend style="text-align: center;">

            <h3 style="color: blue;">
                LISTE D'ELEVES
            </h3>

        </legend>


        <div class="container">

            <div class="form-container">


                @php

                    $userFunction =
                        Auth::user()->function;

                    $isAdminOrDirection =
                        $userFunction === 'Admin' ||
                        $userFunction === 'Direction';

                @endphp


                <!-- =================================================
                     FILTROS: CLASSE + ANO LETIVO
                ================================================== -->

                <form
                    method="GET"
                    action="{{ route('eleves.listeleves') }}"
                    style="
                        margin-bottom: 20px;
                        padding: 15px;
                        background: #f5f7fb;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                    "
                >

                    <table
                        style="
                            width: 100%;
                            border-collapse: collapse;
                        "
                    >

                        <tr>


                            <!-- =====================================
                                 CLASSE
                            ====================================== -->

                            <td
                                style="
                                    width: 30%;
                                    padding-right: 15px;
                                    vertical-align: middle;
                                "
                            >

                                <select
                                    name="classe_id"
                                    id="classe_id"
                                    class="form-control"
                                    style="
                                        width: 100%;
                                        height: 45px;
                                        box-sizing: border-box;
                                    "
                                >

                                    <option value="">
                                        -- Selecionar classe --
                                    </option>


                                    @foreach($classes as $classe)

                                        <option
                                            value="{{ $classe->id }}"
                                            {{ request('classe_id') == $classe->id ? 'selected' : '' }}
                                        >

                                            {{ $classe->code }}

                                        </option>

                                    @endforeach

                                </select>

                            </td>


                            <!-- =====================================
                                 ANO LETIVO
                            ====================================== -->

                            <td
                                style="
                                    width: 30%;
                                    padding-right: 15px;
                                    vertical-align: middle;
                                "
                            >

                                <select
                                    name="annee_scolaire_id"
                                    id="annee_scolaire_id"
                                    class="form-control"
                                    style="
                                        width: 100%;
                                        height: 45px;
                                        box-sizing: border-box;
                                    "
                                >

                                    <option value="">
                                        -- Selecionar ano letivo --
                                    </option>


                                    @foreach($anneesScolaires as $annee)

                                        <option
                                            value="{{ $annee->id }}"
                                            {{ request('annee_scolaire_id') == $annee->id ? 'selected' : '' }}
                                        >

                                            {{ $annee->nome }}

                                            @if($annee->ativo)

                                                (Ativo)

                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </td>


                            <!-- =====================================
                                 FILTRAR
                            ====================================== -->

                            <td
                                style="
                                    width: 20%;
                                    padding-right: 10px;
                                    vertical-align: middle;
                                "
                            >

                                <button
                                    type="submit"
                                    style="
                                        width: 100%;
                                        height: 45px;
                                        background: #1c359d;
                                        color: white;
                                        border: none;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        font-size: 15px;
                                    "
                                >

                                    <i class="fas fa-search"></i>

                                    Filtrar

                                </button>

                            </td>


                            <!-- =====================================
                                 LIMPAR
                            ====================================== -->

                            <td
                                style="
                                    width: 20%;
                                    vertical-align: middle;
                                "
                            >

                                <a
                                    href="{{ route('eleves.listeleves') }}"
                                    style="
                                        width: 100%;
                                        height: 45px;
                                        box-sizing: border-box;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        background: #777;
                                        color: white;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                        text-decoration: none;
                                        font-size: 15px;
                                    "
                                >

                                    <i
                                        class="fas fa-times"
                                        style="margin-right: 5px;"
                                    ></i>

                                    Limpar

                                </a>

                            </td>

                        </tr>

                    </table>

                </form>


                <!-- =================================================
                     LISTA DE ALUNOS
                ================================================== -->

                @if(
                    request()->filled('classe_id') &&
                    request()->filled('annee_scolaire_id')
                )


                    <table
                        border="1"
                        style="
                            width: 100%;
                            border-collapse: collapse;
                        "
                    >

                        <thead>

                            <tr>

                                <th>
                                    Matricule
                                </th>

                                <th>
                                    Nom
                                </th>

                                <th>
                                    Apelido
                                </th>

                                <th>
                                    Classe
                                </th>

                                <th colspan="3">
                                    ACTIONS
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse ($eleves as $eleve)

                                <tr>


                                    <!-- MATRÍCULA -->

                                    <td align="center">

                                        {{ $eleve->matricula }}

                                    </td>


                                    <!-- NOME -->

                                    <td align="center">

                                        {{ $eleve->nome }}

                                    </td>


                                    <!-- APELIDO -->

                                    <td align="center">

                                        {{ $eleve->apelido }}

                                    </td>


                                    <!-- CLASSE -->

                                    <td align="center">

                                        {{
                                            $eleve
                                                ->inscriptions
                                                ->first()
                                                ?->classe
                                                ?->code
                                                ?? '-'
                                        }}

                                    </td>


                                    <!-- =================================
                                         DETALHES
                                    ================================== -->

                                    <td align="center">

                                        <a
                                            href="{{ route('eleves.show', $eleve->id) }}"
                                        >

                                            <img
                                                src="../../img/det.png"
                                                style="width: 30px;"
                                            >

                                        </a>

                                    </td>


                                    <!-- =================================
                                         EDITAR
                                    ================================== -->

                                    @if($isAdminOrDirection)

                                        <td align="center">

                                            <a
                                                href="{{ route('eleves.edit', $eleve->id) }}"
                                            >

                                                <img
                                                    src="../../img/modif02.png"
                                                    style="width: 30px;"
                                                >

                                            </a>

                                        </td>

                                    @else

                                        <td align="center">
                                            —
                                        </td>

                                    @endif


                                    <!-- =================================
                                         ELIMINAR
                                    ================================== -->

                                    @if($isAdminOrDirection)

                                        <td align="center">


                                            <form
                                                id="delete-form-{{ $eleve->id }}"
                                                action="{{ route('eleves.destroy', $eleve->id) }}"
                                                method="POST"
                                                style="display: none;"
                                            >

                                                @csrf

                                                @method('DELETE')

                                            </form>


                                            <button
                                                type="button"
                                                onclick="confirmDelete({{ $eleve->id }})"
                                                style="
                                                    background:none;
                                                    border:none;
                                                "
                                            >

                                                <img
                                                    src="../../img/del0.png"
                                                    style="width: 30px;"
                                                >

                                            </button>


                                        </td>

                                    @else

                                        <td align="center">
                                            —
                                        </td>

                                    @endif


                                </tr>


                            @empty


                                <tr>

                                    <td
                                        colspan="7"
                                        align="center"
                                    >

                                        Nenhum aluno encontrado

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>

                    </table>


                    <!-- =================================================
                         EXPORTAR
                    ================================================== -->

                    <div
                        style="
                            margin-top: 15px;
                        "
                    >

                        <form
                            action="{{ route('eleves.export') }}"
                            method="POST"
                            style="
                                display: inline-block;
                            "
                        >

                            @csrf


                            <!-- =====================================
                                 CLASSE SELECIONADA
                            ====================================== -->

                            <input
                                type="hidden"
                                name="classe_id"
                                value="{{ request('classe_id') }}"
                            >


                            <!-- =====================================
                                 ANO LETIVO SELECIONADO
                            ====================================== -->

                            <input
                                type="hidden"
                                name="annee_scolaire_id"
                                value="{{ request('annee_scolaire_id') }}"
                            >


                            <!-- =====================================
                                 BOTÃO
                            ====================================== -->

                            <button
                                type="submit"
                                class="export-button"
                            >

                                <i class="fas fa-file-excel"></i>

                                EXPORTAR EM EXCEL

                            </button>


                        </form>

                    </div>


                @endif


            </div>

        </div>

    </fieldset>

</div>


<!-- =========================================================
     SWEETALERT - ELIMINAR
========================================================= -->

<script>

function confirmDelete(id) {

    Swal.fire({

        title: 'Tem certeza?',

        text: 'Essa ação não pode ser desfeita.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Sim, excluir!',

        cancelButtonText: 'Cancelar',

        width: '400px'

    }).then((result) => {

        if (result.isConfirmed) {

            document
                .getElementById(
                    'delete-form-' + id
                )
                .submit();

        }

    });

}

</script>


<!-- =========================================================
     MENU SCRIPT
========================================================= -->

<script>

function toggleMenu() {

    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("overlay");


    if (!sidebar || !overlay) {

        console.error(
            "Sidebar ou overlay não encontrados no DOM"
        );

        return;

    }


    sidebar.classList.toggle("open");

    overlay.classList.toggle("active");

}


/* =========================================================
   FECHAR AO CLICAR NO OVERLAY
========================================================= */

document.addEventListener(
    "DOMContentLoaded",
    function () {

        const overlay =
            document.getElementById("overlay");

        const sidebar =
            document.getElementById("sidebar");


        if (overlay) {

            overlay.addEventListener(
                "click",
                function () {

                    sidebar.classList.remove(
                        "open"
                    );

                    overlay.classList.remove(
                        "active"
                    );

                }
            );

        }

    }
);


/* =========================================================
   SUBMENU
========================================================= */

function toggleSubmenu(element) {

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

</script>


</body>

</html>

