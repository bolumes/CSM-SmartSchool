<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool - Anos Letivos</title>

    <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">

    <link rel="icon" href="{{ asset('img/books.png') }}">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">

        <div class="menu-toggle" onclick="toggleMenu()">
            ☰
        </div>

        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" >
        </div>

        <div class="search">
            <input type="hidden" placeholder="Pesquisar...">
        </div>

    </div>


    <!-- Sidebar -->
    @include('partials.sidebargestacad')


    <!-- Conteúdo principal -->
    <div class="main-content">

        <fieldset style="border-radius: 8px; border: 2px solid blue;padding: 20px;">

            <legend style="text-align: center;">

                <h3 style="text-align: center; color: blue;">
                    <i class="fas fa-calendar-alt"></i>
                    Anos Letivos
                </h3>

            </legend>


            <!-- Mensagem de sucesso -->
            @if(session('success'))

                <div
                    id="toast-success"
                    class="toast"
                >
                    {{ session('success') }}
                </div>

            @endif


            <!-- Erros -->
            @if($errors->any())

                <div
                    style="
                        color: red;
                        margin-bottom: 15px;
                    "
                >

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Cabeçalho -->
            <div
                style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 20px;
                    flex-wrap: wrap;
                    gap: 10px;
                "
            >

                <div>

                    <h4 style="margin: 0;">

                        <i class="fas fa-list"></i>
                        Lista de Anos Letivos

                    </h4>

                </div>


                <a
                    href="{{ route('annees-scolaires.create') }}"
                    style="
                        display: inline-block;
                        background: #007bff;
                        color: white;
                        padding: 10px 16px;
                        border-radius: 6px;
                        text-decoration: none;
                    "
                >

                    <i class="fas fa-plus"></i>
                    Novo Ano Letivo

                </a>

            </div>


            <!-- Tabela -->
            <div
                style="
                    width: 100%;
                    overflow-x: auto;
                "
            >

                <table
                    style="
                        width: 100%;
                        border-collapse: collapse;
                        background: white;
                    "
                >

                    <thead>

                        <tr
                            style="
                                background: #007bff;
                                color: white;
                            "
                        >

                            <th style="padding: 12px;">
                                #
                            </th>

                            <th style="padding: 12px;">
                                Ano Letivo
                            </th>

                            <th style="padding: 12px;">
                                Data de Início
                            </th>

                            <th style="padding: 12px;">
                                Data de Fim
                            </th>

                            <th style="padding: 12px;">
                                Estado
                            </th>

                            <th style="padding: 12px;">
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($anneesScolaires as $anneeScolaire)

                            <tr
                                style="
                                    border-bottom: 1px solid #ddd;
                                "
                            >

                                <td
                                    style="
                                        padding: 12px;
                                        text-align: center;
                                    "
                                >
                                    {{ $anneeScolaire->id }}
                                </td>


                                <td style="padding: 12px;">

                                    <strong>
                                        {{ $anneeScolaire->nome }}
                                    </strong>

                                </td>


                                <td style="padding: 12px;">

                                    {{ $anneeScolaire->data_inicio
                                        ? $anneeScolaire->data_inicio->format('d/m/Y')
                                        : '-' }}

                                </td>


                                <td style="padding: 12px;">

                                    {{ $anneeScolaire->data_fim
                                        ? $anneeScolaire->data_fim->format('d/m/Y')
                                        : '-' }}

                                </td>


                                <td
                                    style="
                                        padding: 12px;
                                        text-align: center;
                                    "
                                >

                                    @if($anneeScolaire->ativo)

                                        <span
                                            style="
                                                background: #28a745;
                                                color: white;
                                                padding: 5px 10px;
                                                border-radius: 15px;
                                                font-size: 13px;
                                            "
                                        >
                                            <i class="fas fa-check-circle"></i>
                                            Ativo
                                        </span>

                                    @else

                                        <span
                                            style="
                                                background: #6c757d;
                                                color: white;
                                                padding: 5px 10px;
                                                border-radius: 15px;
                                                font-size: 13px;
                                            "
                                        >
                                            <i class="fas fa-times-circle"></i>
                                            Inativo
                                        </span>

                                    @endif

                                </td>


                                <td
                                    style="
                                        padding: 12px;
                                        text-align: center;
                                        white-space: nowrap;
                                    "
                                >

                                    <!-- Editar -->

                                    <a
                                        href="{{ route(
                                            'annees-scolaires.edit',
                                            $anneeScolaire
                                        ) }}"
                                        title="Editar"
                                        style="
                                            display: inline-block;
                                            background: #ffc107;
                                            color: #212529;
                                            padding: 7px 10px;
                                            border-radius: 5px;
                                            text-decoration: none;
                                            margin-right: 5px;
                                        "
                                    >

                                        <i class="fas fa-edit"></i>

                                    </a>


                                    <!-- Eliminar -->

                                    <form
                                        action="{{ route(
                                            'annees-scolaires.destroy',
                                            $anneeScolaire
                                        ) }}"
                                        method="POST"
                                        style="
                                            display: inline-block;
                                        "
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
                                                background: #dc3545;
                                                color: white;
                                                border: none;
                                                padding: 7px 10px;
                                                border-radius: 5px;
                                                cursor: pointer;
                                            "
                                        >

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    style="
                                        padding: 30px;
                                        text-align: center;
                                        color: #777;
                                    "
                                >

                                    <i
                                        class="fas fa-calendar-times"
                                        style="
                                            font-size: 35px;
                                            margin-bottom: 10px;
                                        "
                                    ></i>

                                    <br>

                                    Nenhum ano letivo registado.

                                    <br><br>

                                    <a
                                        href="{{ route('annees-scolaires.create') }}"
                                        style="
                                            color: #007bff;
                                            text-decoration: none;
                                        "
                                    >

                                        <i class="fas fa-plus"></i>
                                        Criar primeiro ano letivo

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- Paginação -->
            @if($anneesScolaires->hasPages())

                <div
                    style="
                        margin-top: 20px;
                    "
                >

                    {{ $anneesScolaires->links() }}

                </div>

            @endif

        </fieldset>

    </div>


    <!-- Toast -->
    <style>

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #38a169;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation:
                slideIn 0.5s,
                fadeOut 0.5s 3.5s forwards;
        }

        @keyframes slideIn {

            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        @keyframes fadeOut {

            to {
                opacity: 0;
                transform: translateY(-20px);
            }

        }

    </style>


    <!-- Menu -->
    <script>

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