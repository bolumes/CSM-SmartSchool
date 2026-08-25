<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar Utilizador - CSM SmartSchool</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style1.css">

    <link rel="icon" href="../../img/books.png">
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================== -->
    <div class="navbar">

        <div class="menu-toggle" onclick="toggleMenu()">
            ☰
        </div>

        <div class="logo">
            <img src="../../img/logo.png" alt="CSM SmartSchool">
        </div>

        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>

    </div>


    <!-- =========================
         SIDEBAR
    ========================== -->

    @include('partials.sidebarsettings')


    <!-- =========================
         CONTEÚDO PRINCIPAL
    ========================== -->

    <div class="main-content">

        @php

            /*
            |--------------------------------------------------------------------------
            | PERFIL DO UTILIZADOR AUTENTICADO
            |--------------------------------------------------------------------------
            */

            $currentUserFunction = optional(Auth::user())->function;


            /*
            |--------------------------------------------------------------------------
            | PERFIS QUE O UTILIZADOR PODE CRIAR
            |--------------------------------------------------------------------------
            */

            $allowedFunctions = match ($currentUserFunction) {

                /*
                |--------------------------------------------------------------------------
                | ADMINISTRADOR
                | Pode criar todos os perfis
                |--------------------------------------------------------------------------
                */

                'Admin' => [
                    'Admin',
                    'Direction',
                    'Se_Direction',
                    'Se_Administratif',
                    'Se_Financier',
                    'Professeur',
                    'Parent',
                    'Eleve',
                ],


                /*
                |--------------------------------------------------------------------------
                | DIRETOR
                | Não pode criar Administrador nem outro Diretor
                |--------------------------------------------------------------------------
                */

                'Direction' => [
                    'Se_Direction',
                    'Se_Administratif',
                    'Se_Financier',
                    'Professeur',
                    'Parent',
                    'Eleve',
                ],


                /*
                |--------------------------------------------------------------------------
                | SECRETÁRIO ADMINISTRATIVO
                |--------------------------------------------------------------------------
                */

                'Se_Administratif' => [
                    'Sec_Direction',
                    'Se_Financier',
                    'Professeur',
                    'Parent',
                    'Eleve',
                ],


                /*
                |--------------------------------------------------------------------------
                | SECRETÁRIO DE DIREÇÃO
                | Pode criar apenas alunos e encarregados
                |--------------------------------------------------------------------------
                */

                'Se_Direction' => [
                    'Parent',
                    'Eleve',
                ],


                /*
                |--------------------------------------------------------------------------
                | SECRETÁRIO FINANCEIRO
                |--------------------------------------------------------------------------
                */

                'Se_Financier' => [
                    'Parent',
                    'Eleve',
                ],


                /*
                |--------------------------------------------------------------------------
                | OUTROS PERFIS
                | Não podem criar utilizadores
                |--------------------------------------------------------------------------
                */

                default => [],

            };


            /*
            |--------------------------------------------------------------------------
            | NOMES DOS PERFIS
            |--------------------------------------------------------------------------
            */

            $functionNames = [

                'Admin' => 'Administrador',

                'Direction' => 'Diretor',

                'Se_Direction' => 'Secretário de Direção',

                'Se_Administratif' => 'Secretário Administrativo',

                'Se_Financier' => 'Secretário Financeiro',

                'Professeur' => 'Professor',

                'Parent' => 'Encarregado de Educação',

                'Eleve' => 'Aluno',

            ];

        @endphp


        <!-- =========================
             VERIFICAÇÃO DE PERMISSÃO
        ========================== -->

        @if(count($allowedFunctions) === 0)

            <fieldset style="
                border-radius: 8px;
                border: 2px solid #dc3545;
                padding: 30px;
            ">

                <legend style="text-align: center;">
                    <h3 style="
                        text-align: center;
                        color: #dc3545;
                    ">
                        ACESSO NEGADO
                    </h3>
                </legend>

                <div style="
                    text-align: center;
                    padding: 30px;
                ">

                    <i class="fas fa-lock"
                       style="
                           font-size: 50px;
                           color: #dc3545;
                           margin-bottom: 20px;
                       ">
                    </i>

                    <p>
                        Não possui permissão para criar utilizadores.
                    </p>

                </div>

            </fieldset>


        @else


            <!-- =========================
                 FORMULÁRIO
            ========================== -->

            <fieldset style="
                border-radius: 8px;
                border: 2px solid blue;
            ">

                <legend style="text-align: center;">

                    <h3 style="
                        text-align: center;
                        color: blue;
                    ">
                        CRIAR UTILIZADOR
                    </h3>

                </legend>


                <!-- Container -->

                <div class="container">


                    <!-- =========================
                         IMAGEM
                    ========================== -->

                    <div class="form-image">

                        <img
                            src="../../img/ajouter.png"
                            alt="Adicionar utilizador"
                            style="
                                height: 50px;
                                margin-left: 40px;
                            "
                        >

                    </div>


                    <!-- =========================
                         FORMULÁRIO
                    ========================== -->

                    <div class="form-container">

                        <form
                            action="{{ route('users.store') }}"
                            method="POST"
                        >

                            @csrf


                            <!-- =========================
                                 MENSAGEM DE SUCESSO
                            ========================== -->

                            @if(session('success'))

                                <div id="toast-success" class="toast">

                                    {{ session('success') }}

                                </div>

                                <style>

                                    .toast {

                                        position: fixed;

                                        top: 20px;

                                        right: 20px;

                                        background-color: #38a169;

                                        color: white;

                                        padding: 15px 25px;

                                        border-radius: 8px;

                                        box-shadow:
                                            0 5px 15px
                                            rgba(0, 0, 0, 0.2);

                                        z-index: 9999;

                                        animation:
                                            slideIn 0.5s,
                                            fadeOut 0.5s 3.5s forwards;

                                    }


                                    @keyframes slideIn {

                                        from {

                                            opacity: 0;

                                            transform:
                                                translateY(-20px);

                                        }

                                        to {

                                            opacity: 1;

                                            transform:
                                                translateY(0);

                                        }

                                    }


                                    @keyframes fadeOut {

                                        to {

                                            opacity: 0;

                                            transform:
                                                translateY(-20px);

                                            display: none;

                                        }

                                    }

                                </style>

                            @endif


                            <!-- =========================
                                 ERROS
                            ========================== -->

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


                            <!-- =========================
                                 NOME
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="firstname"
                                    class="form-label"
                                >
                                    Nome
                                </label>

                                <input
                                    type="text"
                                    id="firstname"
                                    class="form-control"
                                    name="firstname"
                                    value="{{ old('firstname') }}"
                                    required
                                >

                            </div>


                            <!-- =========================
                                 APELIDO
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="lastname"
                                    class="form-label"
                                >
                                    Apelido
                                </label>

                                <input
                                    type="text"
                                    id="lastname"
                                    class="form-control"
                                    name="lastname"
                                    value="{{ old('lastname') }}"
                                    required
                                >

                            </div>


                            <!-- =========================
                                 TELEFONE
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="telephone"
                                    class="form-label"
                                >
                                    Telefone
                                </label>

                                <input
                                    type="text"
                                    id="telephone"
                                    class="form-control"
                                    name="telephone"
                                    value="{{ old('telephone') }}"
                                >

                            </div>


                            <!-- =========================
                                 EMAIL
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    class="form-control"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                >

                            </div>


                            <!-- =========================
                                 MORADA
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="address"
                                    class="form-label"
                                >
                                    Morada
                                </label>

                                <input
                                    type="text"
                                    id="address"
                                    class="form-control"
                                    name="address"
                                    value="{{ old('address') }}"
                                >

                            </div>


                            <!-- =========================
                                 FUNÇÃO
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="function"
                                    class="form-label"
                                >
                                    Função
                                </label>

                                <select
                                    class="form-control"
                                    name="function"
                                    id="function"
                                    required
                                >

                                    <option value="">
                                        Escolher...
                                    </option>


                                    @foreach($allowedFunctions as $function)

                                        <option
                                            value="{{ $function }}"

                                            {{ old('function') === $function
                                                ? 'selected'
                                                : ''
                                            }}
                                        >

                                            {{ $functionNames[$function] }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <!-- =========================
                                 PASSWORD
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    Palavra-passe
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    required
                                >

                            </div>


                            <!-- =========================
                                 CONFIRMAR PASSWORD
                            ========================== -->

                            <div class="col-md-6">

                                <label
                                    for="password_confirmation"
                                    class="form-label"
                                >
                                    Confirmar Palavra-passe
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                >

                            </div>


                            <!-- =========================
                                 DESCRIÇÃO
                            ========================== -->

                            <div class="col-md-12">

                                <label
                                    for="description"
                                    class="form-label"
                                >
                                    Descrição
                                </label>

                                <textarea
                                    class="form-control"
                                    id="description"
                                    name="description"
                                    rows="4"
                                >{{ old('description') }}</textarea>

                            </div>


                            <!-- =========================
                                 BOTÃO
                            ========================== -->

                            <button
                                type="submit"
                                class="mt-3"
                            >

                                <i class="fas fa-save"></i>

                                Enregistrer

                            </button>


                        </form>

                    </div>

                </div>

            </fieldset>

        @endif

    </div>


    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script>

        /*
        |--------------------------------------------------------------------------
        | ABRIR / FECHAR SIDEBAR
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | SUBMENU
        |--------------------------------------------------------------------------
        */

        function toggleSubmenu(element) {

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

    </script>

</body>

</html>
