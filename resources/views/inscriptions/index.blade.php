<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anos Letivos - CSM-SmartSchool</title>

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

</head>

<body>

    <!-- =====================================================
         NAVBAR
    ====================================================== -->

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
                type="hidden"
                placeholder="Pesquisar..."
            >

        </div>

    </div>


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    @include('partials.sidebargestacad')


    <!-- =====================================================
         CONTEÚDO PRINCIPAL
    ====================================================== -->

    <div class="main-content">

        <fieldset
            style="
                border-radius:8px;
                border:2px solid blue;
            "
        >

            <legend style="text-align:center;">

                <h3
                    style="
                        text-align:center;
                        color:blue;
                    "
                >

                    <i class="fas fa-calendar-alt"></i>

                    Anos Letivos

                </h3>

            </legend>


            <!-- =====================================================
                 MENSAGEM DE SUCESSO
            ====================================================== -->

            @if (session('success'))

                <div
                    id="toast-success"
                    class="toast"
                >

                    <i class="fas fa-check-circle"></i>

                    {{ session('success') }}

                </div>

            @endif


            <!-- =====================================================
                 ERROS
            ====================================================== -->

            @if ($errors->any())

                <div
                    style="
                        background:#f8d7da;
                        color:#721c24;
                        padding:15px;
                        border-radius:8px;
                        margin-bottom:20px;
                        border:1px solid #f5c6cb;
                    "
                >

                    <strong>
                        Por favor, corrija os seguintes erros:
                    </strong>

                    <ul style="margin-bottom:0;">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- =====================================================
                 CABEÇALHO DA LISTAGEM
            ====================================================== -->

            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:20px;
                    gap:15px;
                    flex-wrap:wrap;
                "
            >

                <div>

                    <h4
                        style="
                            margin:0;
                            color:#333;
                        "
                    >

                        <i class="fas fa-list"></i>

                        Lista de Anos Letivos

                    </h4>

                    <small style="color:#777;">

                        Gerencie os anos letivos da escola.

                    </small>

                </div>


                <!-- Novo Ano Letivo -->

                <a
                    href="{{ route('annees-scolaires.create') }}"
                    style="
                        display:inline-block;
                        padding:10px 18px;
                        background:#007bff;
                        color:white;
                        text-decoration:none;
                        border-radius:5px;
                    "
                >

                    <i class="fas fa-plus"></i>

                    Novo Ano Letivo

                </a>

            </div>


            <!-- =====================================================
                 TABELA
            ====================================================== -->

            <div
                style="
                    width:100%;
                    overflow-x:auto;
                "
            >

                <table
                    style="
                        width:100%;
                        border-collapse:collapse;
                        background:white;
                    "
                >

                    <thead>

                        <tr
                            style="
                                background:#f1f4f8;
                                color:#333;
                            "
                        >

                            <th
                                style="
                                    padding:12px;
                                    border:1px solid #ddd;
                                    text-align:center;
                                "
                            >
                                #
                            </th>

                            <th
                                style="
                                    padding:12px;
                                    border:1px solid #ddd;
                                    text-align:left;
                                "
                            >
                                Ano Letivo
                            </th>

                            <th
                                style="
                                    padding:12px;
                                    border:1px solid #ddd;
                                    text-align:center;
                                "
                            >
                                Data de Início
                            </th>

                            <th
                                style="
                                    padding:12px;
                                    border:1px solid #ddd;
                                    text-align:center;
                                "
                            >
                                Data de Fim
                            </th>

                            <th
                                style="
                                    padding:12px;
                                    border:1px solid #ddd;
                                    text-align:center;
                                "
                            >
                                Estado
                            </th>

                            <th
                                style="
                                    padding:12px;
                                    border:1px solid #ddd;
                                    text-align:center;
                                "
                            >
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($anneesScolaires as $annee)

                            <tr>

                                <!-- Número -->

                                <td
                                    style="
                                        padding:12px;
                                        border:1px solid #ddd;
                                        text-align:center;
                                    "
                                >

                                    {{ $inscriptions->firstItem() + $loop->index }}

                                </td>


                                <!-- Ano -->

                                <td
                                    style="
                                        padding:12px;
                                        border:1px solid #ddd;
                                    "
                                >

                                    <strong>

                                        <i
                                            class="fas fa-calendar-alt"
                                            style="color:#007bff;"
                                        ></i>

                                        {{ $annee->nome }}

                                    </strong>

                                </td>


                                <!-- Data início -->

                                <td
                                    style="
                                        padding:12px;
                                        border:1px solid #ddd;
                                        text-align:center;
                                    "
                                >

                                    {{ $annee->data_inicio
                                        ? \Carbon\Carbon::parse($annee->data_inicio)->format('d/m/Y')
                                        : '—'
                                    }}

                                </td>


                                <!-- Data fim -->

                                <td
                                    style="
                                        padding:12px;
                                        border:1px solid #ddd;
                                        text-align:center;
                                    "
                                >

                                    {{ $annee->data_fim
                                        ? \Carbon\Carbon::parse($annee->data_fim)->format('d/m/Y')
                                        : '—'
                                    }}

                                </td>


                                <!-- Estado -->

                                <td
                                    style="
                                        padding:12px;
                                        border:1px solid #ddd;
                                        text-align:center;
                                    "
                                >

                                    @if ($annee->ativo)

                                        <span
                                            style="
                                                display:inline-block;
                                                padding:5px 12px;
                                                background:#d4edda;
                                                color:#155724;
                                                border-radius:20px;
                                                font-size:13px;
                                                font-weight:bold;
                                            "
                                        >

                                            <i class="fas fa-check-circle"></i>

                                            Ativo

                                        </span>

                                    @else

                                        <span
                                            style="
                                                display:inline-block;
                                                padding:5px 12px;
                                                background:#e9ecef;
                                                color:#6c757d;
                                                border-radius:20px;
                                                font-size:13px;
                                                font-weight:bold;
                                            "
                                        >

                                            <i class="fas fa-times-circle"></i>

                                            Encerrado

                                        </span>

                                    @endif

                                </td>


                                <!-- Ações -->

                                <td
                                    style="
                                        padding:12px;
                                        border:1px solid #ddd;
                                        text-align:center;
                                    "
                                >

                                    <div
                                        style="
                                            display:flex;
                                            justify-content:center;
                                            gap:6px;
                                            flex-wrap:wrap;
                                        "
                                    >

                                        <!-- Ver -->

                                        <a
                                            href="{{ route(
                                                'annees-scolaires.show',
                                                $annee
                                            ) }}"
                                            title="Ver"
                                            style="
                                                display:inline-block;
                                                padding:7px 10px;
                                                background:#17a2b8;
                                                color:white;
                                                text-decoration:none;
                                                border-radius:4px;
                                            "
                                        >

                                            <i class="fas fa-eye"></i>

                                        </a>


                                        <!-- Editar -->

                                        <a
                                            href="{{ route(
                                                'annees-scolaires.edit',
                                                $annee
                                            ) }}"
                                            title="Editar"
                                            style="
                                                display:inline-block;
                                                padding:7px 10px;
                                                background:#ffc107;
                                                color:#212529;
                                                text-decoration:none;
                                                border-radius:4px;
                                            "
                                        >

                                            <i class="fas fa-edit"></i>

                                        </a>


                                        <!-- Eliminar -->

                                        <form
                                            action="{{ route(
                                                'annees-scolaires.destroy',
                                                $annee
                                            ) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="
                                                return confirm(
                                                    'Tem certeza que deseja eliminar este ano letivo?'
                                                );
                                            "
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Eliminar"
                                                style="
                                                    padding:7px 10px;
                                                    background:#dc3545;
                                                    color:white;
                                                    border:none;
                                                    border-radius:4px;
                                                    cursor:pointer;
                                                "
                                            >

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    style="
                                        padding:35px;
                                        text-align:center;
                                        color:#777;
                                        border:1px solid #ddd;
                                    "
                                >

                                    <i
                                        class="fas fa-calendar-times"
                                        style="
                                            font-size:40px;
                                            color:#aaa;
                                            margin-bottom:10px;
                                        "
                                    ></i>

                                    <br>

                                    <strong>
                                        Nenhum ano letivo encontrado.
                                    </strong>

                                    <br>

                                    <small>
                                        Clique em "Novo Ano Letivo"
                                        para adicionar o primeiro.
                                    </small>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- =====================================================
                 PAGINAÇÃO
            ====================================================== -->

            @if ($inscriptions->hasPages())

                <div
                    style="
                        margin-top:20px;
                        display:flex;
                        justify-content:center;
                    "
                >

                    {{ $anneesScolaires->links() }}

                </div>

            @endif

        </fieldset>

    </div>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <style>

        .toast {

            position:fixed;

            top:20px;

            right:20px;

            background-color:#38a169;

            color:white;

            padding:15px 25px;

            border-radius:8px;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.2);

            z-index:9999;

            animation:
                slideIn 0.5s,
                fadeOut 0.5s 3.5s forwards;

        }


        @keyframes slideIn {

            from {

                opacity:0;

                transform:translateY(-20px);

            }

            to {

                opacity:1;

                transform:translateY(0);

            }

        }


        @keyframes fadeOut {

            to {

                opacity:0;

                transform:translateY(-20px);

            }

        }

    </style>


    <!-- =====================================================
         SCRIPT MENU
    ====================================================== -->

    <script>

        function toggleMenu() {

            const sidebar =
                document.getElementById("sidebar");

            const overlay =
                document.getElementById("overlay");

            if (sidebar) {

                sidebar.classList.toggle("open");

            }

            if (overlay) {

                overlay.classList.toggle("active");

            }

        }


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