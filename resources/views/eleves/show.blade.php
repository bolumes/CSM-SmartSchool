<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Detalhes do Aluno - CSM-SmartSchool
    </title>

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

        .student-card {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .student-header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            margin-bottom: 20px;
            background: linear-gradient(
                135deg,
                #1c359d,
                #34495e
            );
            color: white;
            border-radius: 10px;
        }

        .student-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1c359d;
            font-size: 32px;
        }

        .student-header h2 {
            margin: 0;
        }

        .student-header p {
            margin: 5px 0 0;
            opacity: .9;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .details-table th,
        .details-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .details-table th {
            width: 35%;
            background-color: #1c359d;
            color: white;
            text-align: left;
        }

        .details-table td {
            color: #222;
            background-color: #f8f9fa;
        }

        .section-title {
            margin-top: 25px;
            margin-bottom: 10px;
            padding: 10px 15px;
            background-color: #1c359d;
            color: white;
            border-radius: 6px;
        }

        .inscription-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inscription-table th {
            background-color: #34495e;
            color: white;
            padding: 10px;
        }

        .inscription-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #38a169;
            color: white;
        }

        .badge-secondary {
            background-color: #718096;
            color: white;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn-custom {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-primary-custom {
            background-color: #1c359d;
        }

        .btn-warning-custom {
            background-color: #f39c12;
        }

        .btn-danger-custom {
            background-color: #c0392b;
        }

        .btn-secondary-custom {
            background-color: #7f8c8d;
        }

        .empty-message {
            padding: 15px;
            background-color: #f1f5f9;
            border-radius: 6px;
            color: #555;
        }

        @media (max-width: 700px) {

            .student-header {
                flex-direction: column;
                text-align: center;
            }

            .details-table th,
            .details-table td {
                display: block;
                width: auto;
            }

            .inscription-table {
                font-size: 13px;
            }

        }

    </style>

</head>

<body>

    <!-- =========================================================
         NAVBAR
    ========================================================== -->

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


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    @include('partials.sidebargestacad')


    <!-- =========================================================
         CONTEÚDO
    ========================================================== -->

    <div class="main-content">

        <fieldset
            style="
                border-radius: 8px;
                border: 2px solid blue;
                padding: 20px;
            "
        >

            <legend>

                <h3
                    style="
                        text-align: center;
                        color: blue;
                        padding: 0 15px;
                    "
                >
                    DÉTAILS ÉLÈVE
                </h3>

            </legend>


            <!-- =====================================================
                 MENSAGEM DE SUCESSO
            ====================================================== -->

            @if(session('success'))

                <div
                    id="toast-success"
                    class="toast"
                    style="
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background-color: #38a169;
                        color: white;
                        padding: 15px 25px;
                        border-radius: 8px;
                        box-shadow: 0 5px 15px rgba(0,0,0,.2);
                        z-index: 9999;
                    "
                >

                    {{ session('success') }}

                </div>

            @endif


            <!-- =====================================================
                 CONTAINER
            ====================================================== -->

            <div class="container">

                <div class="form-image">

                    <img
                        src="{{ asset('img/det.png') }}"
                        alt="Detalhes do aluno"
                        style="
                            height: 70px;
                            margin-left: 40px;
                        "
                    >

                </div>


                <div class="form-container">

                    <div class="student-card">


                        <!-- =================================================
                             CABEÇALHO DO ALUNO
                        ================================================== -->

                        <div class="student-header">

                            <div class="student-icon">

                                <i class="fas fa-user-graduate"></i>

                            </div>

                            <div>

                                <h2>

                                    {{ $eleve->nome }}

                                    @if($eleve->apelido)
                                        {{ $eleve->apelido }}
                                    @endif

                                </h2>

                                <p>

                                    Matrícula:
                                    <strong>
                                        {{ $eleve->matricula }}
                                    </strong>

                                </p>

                            </div>

                        </div>


                        <!-- =================================================
                             DADOS PESSOAIS
                        ================================================== -->

                        <h3 class="section-title">

                            <i class="fas fa-user"></i>

                            Informations de l'élève

                        </h3>


                        <table class="details-table">

                            <tbody>

                                <tr>

                                    <th>
                                        ID
                                    </th>

                                    <td>
                                        {{ $eleve->id }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Matricule
                                    </th>

                                    <td>

                                        <strong>
                                            {{ $eleve->matricula }}
                                        </strong>

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Nom
                                    </th>

                                    <td>
                                        {{ $eleve->nome }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Apelido
                                    </th>

                                    <td>
                                        {{ $eleve->apelido ?? '-' }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Date de naissance
                                    </th>

                                    <td>

                                        @if($eleve->data_nascimento)

                                            {{ \Carbon\Carbon::parse($eleve->data_nascimento)->format('d/m/Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Sexe
                                    </th>

                                    <td>
                                        {{ $eleve->sexo ?? '-' }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Adresse
                                    </th>

                                    <td>
                                        {{ $eleve->endereco ?? '-' }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Téléphone
                                    </th>

                                    <td>
                                        {{ $eleve->telefone ?? '-' }}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Date de création
                                    </th>

                                    <td>

                                        @if($eleve->created_at)

                                            {{ $eleve->created_at->format('d/m/Y H:i') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                </tr>

                            </tbody>

                        </table>


                        <!-- =================================================
                             INSCRIÇÕES
                        ================================================== -->

                        <h3 class="section-title">

                            <i class="fas fa-school"></i>

                            Inscriptions

                        </h3>


                        @if($eleve->inscriptions->count())

                            <div
                                class="table-responsive"
                                style="overflow-x:auto;"
                            >

                                <table class="inscription-table">

                                    <thead>

                                        <tr>

                                            <th>
                                                Année scolaire
                                            </th>

                                            <th>
                                                Classe
                                            </th>

                                            <th>
                                                Date d'inscription
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @foreach($eleve->inscriptions as $inscription)

                                            <tr>

                                                <td>

                                                    {{ $inscription->anneeScolaire?->nome ?? '-' }}

                                                </td>

                                                <td>

                                                    {{ $inscription->classe?->code ?? '-' }}

                                                </td>

                                                <td>

                                                    @if($inscription->data_inscricao)

                                                        {{ \Carbon\Carbon::parse($inscription->data_inscricao)->format('d/m/Y') }}

                                                    @else

                                                        -

                                                    @endif

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        @else

                            <div class="empty-message">

                                <i class="fas fa-info-circle"></i>

                                Aucune inscription trouvée.

                            </div>

                        @endif


                        <!-- =================================================
                             AÇÕES
                        ================================================== -->

                        <div class="actions">

                            <a
                                href="{{ route('eleves.edit', $eleve->id) }}"
                                class="btn-custom btn-warning-custom"
                            >

                                <i class="fas fa-edit"></i>

                                Modifier

                            </a>


                            <a
                                href="{{ route('eleves.listeleves') }}"
                                class="btn-custom btn-secondary-custom"
                            >

                                <i class="fas fa-arrow-left"></i>

                                Retour

                            </a>


                            <form
                                action="{{ route('eleves.destroy', $eleve->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="
                                    return confirm(
                                        'Voulez-vous vraiment supprimer cet élève ?'
                                    );
                                "
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-custom btn-danger-custom"
                                >

                                    <i class="fas fa-trash"></i>

                                    Supprimer

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </fieldset>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>

        function toggleMenu()
        {
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


        function toggleSubmenu(element)
        {
            element.classList.toggle("open");

            const submenu =
                element.nextElementSibling;

            if (!submenu) {
                return;
            }

            submenu.style.display =
                submenu.style.display === "flex"
                    ? "none"
                    : "flex";
        }


        setTimeout(function()
        {
            const toast =
                document.getElementById(
                    "toast-success"
                );

            if (toast) {
                toast.remove();
            }

        }, 4000);

    </script>

</body>

</html>