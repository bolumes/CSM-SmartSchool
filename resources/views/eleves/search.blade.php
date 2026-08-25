<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool</title>

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/style1.css') }}"
    >

    <link
        rel="icon"
        href="{{ asset('img/books.png') }}"
    >

    <style>

        tr {
            height: 40px;
        }

        tbody tr:hover {
            background-color: #afc393;
            cursor: pointer;
            color: blue;
        }

        th {
            background-color: #1c359d;
            color: white;
            padding: 10px;
        }

        td {
            padding: 8px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .search-box input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-box button {
            padding: 10px 20px;
            background-color: #1c359d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #142674;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .alert-info {
            background-color: #d9edf7;
            color: #31708f;
        }

        .alert-warning {
            background-color: #fcf8e3;
            color: #8a6d3b;
        }

        .active-year {
            background-color: #e8f5e9;
            border: 1px solid #81c784;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            background-color: #1c359d;
            color: white;
            font-size: 13px;
        }

        .btn-action {
            display: inline-block;
        }

    </style>

</head>


<body>


<!-- ==============================================================
     NAVBAR
     ============================================================== -->

<div class="navbar">

    <div
        class="menu-toggle"
        onclick="toggleMenu()"
    >
        ☰
    </div>


    <div class="logo">

        <img
            src="{{ asset('img/logo.png') }}"
            alt="CSM-SmartSchool"
        >

    </div>


    <div class="search">

        <input
            type="text"
            placeholder="Pesquisar..."
        >

    </div>

</div>


<!-- ==============================================================
     SIDEBAR
     ============================================================== -->

@include('partials.sidebargestacad')


<!-- ==============================================================
     CONTEÚDO
     ============================================================== -->

<div class="main-content">

    <fieldset
        style="
            border-radius: 8px;
            border: 2px solid blue;
        "
    >

        <legend style="text-align: center;">

            <h3 style="color: blue;">
                RECHERCHER ÉLÈVE
            </h3>

        </legend>


        <div class="container">


            <!-- ======================================================
                 IMAGEM
                 ====================================================== -->

            <div class="form-image">

                <img
                    src="{{ asset('img/procurar.png') }}"
                    alt="Pesquisar aluno"
                    style="
                        height: 50px;
                        margin-left: 40px;
                    "
                >

            </div>


            <!-- ======================================================
                 FORMULÁRIO
                 ====================================================== -->

            <div class="form-container">


                <!-- ==================================================
                     MENSAGEM DE SUCESSO
                     ================================================== -->

                @if(session('success'))

                    <div
                        style="
                            background-color: #38a169;
                            color: white;
                            padding: 12px;
                            border-radius: 5px;
                            margin-bottom: 15px;
                        "
                    >

                        {{ session('success') }}

                    </div>

                @endif


                <!-- ==================================================
                     ERROS
                     ================================================== -->

                @if($errors->any())

                    <div
                        style="
                            background-color: #f8d7da;
                            color: #721c24;
                            padding: 12px;
                            border-radius: 5px;
                            margin-bottom: 15px;
                        "
                    >

                        <ul style="margin: 0;">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- ==================================================
                     ANO LETIVO ATIVO
                     ================================================== -->

                @if($anneeScolaireActive)

                    <div class="active-year">

                        <strong>
                            Ano letivo ativo:
                        </strong>

                        {{ $anneeScolaireActive->nome }}

                    </div>

                @else

                    <div class="alert alert-warning">

                        <strong>Atenção:</strong>

                        Não existe nenhum ano letivo ativo.

                    </div>

                @endif


                <!-- ==================================================
                     PESQUISA
                     ================================================== -->

                <form
                    class="search-box"
                    action="{{ route('eleves.search') }}"
                    method="GET"
                >

                    <input
                        type="search"
                        name="matricula"
                        value="{{ request('matricula') }}"
                        placeholder="Digite a matrícula (ex.: CSM001)"
                        autocomplete="off"
                        autofocus
                    >


                    <button type="submit">

                        <i class="fas fa-search"></i>

                        Pesquisar

                    </button>

                </form>


                <hr
                    style="
                        width: 100%;
                        height: 2px;
                        background-color: blue;
                        margin-top: 20px;
                    "
                >


                <!-- ==================================================
                     RESULTADOS
                     ================================================== -->

                @if(request()->filled('matricula'))


                    @if($eleves->count())


                        <div
                            class="table-responsive"
                            style="margin-top: 20px;"
                        >

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
                                            Matricula
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

                                        <th>
                                            Ano Letivo
                                        </th>

                                        <th colspan="2">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                @foreach($eleves as $eleve)


                                    @php

                                        /*
                                         * Como o controller carregou
                                         * somente as inscrições do ano ativo,
                                         * a primeira inscrição é a correta.
                                         */

                                        $inscription =
                                            $eleve->inscriptions->first();

                                    @endphp


                                    <tr>


                                        <!-- =================================
                                             MATRÍCULA
                                             ================================= -->

                                        <td align="center">

                                            <strong>
                                                {{ $eleve->matricula }}
                                            </strong>

                                        </td>


                                        <!-- =================================
                                             NOME
                                             ================================= -->

                                        <td align="center">

                                            {{ $eleve->nome }}

                                        </td>


                                        <!-- =================================
                                             APELIDO
                                             ================================= -->

                                        <td align="center">

                                            {{ $eleve->apelido }}

                                        </td>


                                        <!-- =================================
                                             CLASSE
                                             ================================= -->

                                        <td align="center">

                                            @if($inscription?->classe)

                                                <span class="badge">

                                                    {{ $inscription->classe->code }}

                                                </span>

                                            @else

                                                <span
                                                    style="color: #999;"
                                                >
                                                    Sem classe
                                                </span>

                                            @endif

                                        </td>


                                        <!-- =================================
                                             ANO LETIVO
                                             ================================= -->

                                        <td align="center">

                                            @if($inscription?->anneeScolaire)

                                                {{ $inscription->anneeScolaire->nome }}

                                            @elseif($anneeScolaireActive)

                                                {{ $anneeScolaireActive->nome }}

                                            @else

                                                -

                                            @endif

                                        </td>


                                        <!-- =================================
                                             DETALHES
                                             ================================= -->

                                        <td align="center">

                                            <a
                                                href="{{ route('eleves.show', $eleve->id) }}"
                                                class="btn-action"
                                            >

                                                <img
                                                    src="{{ asset('img/det.png') }}"
                                                    style="width: 30px;"
                                                    alt="Detalhes"
                                                >

                                            </a>

                                        </td>


                                        <!-- =================================
                                             EDITAR
                                             ================================= -->

                                        @if(
                                            Auth::check()
                                            &&
                                            (
                                                Auth::user()->function === 'Admin'
                                                ||
                                                Auth::user()->function === 'Direction'
                                            )
                                        )

                                            <td align="center">

                                                <a
                                                    href="{{ route('eleves.edit', $eleve->id) }}"
                                                    class="btn-action"
                                                >

                                                    <img
                                                        src="{{ asset('img/modif02.png') }}"
                                                        style="width: 30px;"
                                                        alt="Editar"
                                                    >

                                                </a>

                                            </td>

                                        @else

                                            <td align="center">

                                                —

                                            </td>

                                        @endif


                                    </tr>


                                @endforeach


                                </tbody>

                            </table>

                        </div>


                    @else


                        <!-- ==================================================
                             NENHUM RESULTADO
                             ================================================== -->

                        <div class="alert alert-info">

                            <strong>
                                Nenhum aluno encontrado.
                            </strong>

                            <br>

                            Nenhum aluno foi encontrado para a matrícula:

                            <strong>
                                {{ request('matricula') }}
                            </strong>

                        </div>


                    @endif


                @endif


            </div>

        </div>

    </fieldset>

</div>


<!-- ==============================================================
     MENU SCRIPT
     ============================================================== -->

<script>

function toggleMenu()
{
    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("overlay");


    if (!sidebar || !overlay) {

        console.error(
            "Sidebar ou overlay não encontrados."
        );

        return;
    }


    sidebar.classList.toggle("open");

    overlay.classList.toggle("active");
}


document.addEventListener(
    "DOMContentLoaded",
    function ()
    {

        const overlay =
            document.getElementById("overlay");

        const sidebar =
            document.getElementById("sidebar");


        if (overlay && sidebar) {

            overlay.addEventListener(
                "click",
                function ()
                {

                    sidebar.classList.remove("open");

                    overlay.classList.remove("active");

                }
            );

        }

    }
);


function toggleSubmenu(element)
{

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