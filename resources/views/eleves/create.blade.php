<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool - Novo Aluno</title>

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

        /* =====================================================
           FORMULÁRIO
        ===================================================== */

        .student-form {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 7px;
            color: #333;
        }

        .form-control {
            width: 100%;
            box-sizing: border-box;
            padding: 10px 12px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 15px;
            background-color: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #1c359d;
            box-shadow: 0 0 0 2px rgba(28, 53, 157, 0.10);
        }


        /* =====================================================
           MATRÍCULA
        ===================================================== */

        .matricula-readonly {
            background-color: #eeeeee !important;
            color: #1c359d !important;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: not-allowed;
        }


        /* =====================================================
           BOTÕES
        ===================================================== */

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-save {
            background: #1c359d;
            color: white;
            border: none;
            padding: 11px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-save:hover {
            background: #142778;
        }

        .btn-cancel {
            text-decoration: none;
            background: #777;
            color: white;
            padding: 11px 20px;
            border-radius: 5px;
        }

        .btn-cancel:hover {
            background: #555;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;

            background: #38a169;
            color: white;

            padding: 15px 25px;

            border-radius: 8px;

            font-weight: bold;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);

            z-index: 9999;

            opacity: 0;

            transform: translateY(-20px);

            animation:
                slideIn 0.5s forwards,
                fadeOut 0.5s 5s forwards;
        }

        @keyframes slideIn {

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


        /* =====================================================
           ERROS
        ===================================================== */

        .error-box {

            background: #ffeaea;

            border-left: 4px solid #dc3545;

            padding: 12px 15px;

            margin-bottom: 20px;

            border-radius: 4px;

            color: #a00000;

        }

        .error-box ul {

            margin: 8px 0 0 20px;

        }

        .error-box li {

            margin-bottom: 4px;

        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            .form-row {

                grid-template-columns: 1fr;

            }

            .form-actions {

                flex-direction: column;

                align-items: stretch;

            }

            .btn-save,
            .btn-cancel {

                text-align: center;

            }

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
========================================================= -->

@include('partials.sidebargestacad')


<!-- =========================================================
     CONTEÚDO
========================================================= -->

<div class="main-content">

    <fieldset
        style="
            border-radius: 8px;
            border: 2px solid blue;
            padding: 20px;
        "
    >

        <legend style="text-align: center;">

            <h3 style="color: blue;">

                <i class="fas fa-user-plus"></i>

                CRIAR NOVO ALUNO

            </h3>

        </legend>


        <div class="container">


            <!-- =================================================
                 IMAGEM
            ================================================== -->

            <div
                class="form-image"
                style="
                    text-align: center;
                    margin-bottom: 20px;
                "
            >

                <img
                    src="{{ asset('img/ajouter.png') }}"
                    alt="Adicionar aluno"
                    style="height: 60px;"
                >

            </div>


            <!-- =================================================
                 FORM CONTAINER
            ================================================== -->

            <div class="form-container">


                <!-- =================================================
                     MENSAGEM DE SUCESSO
                ================================================== -->

                @if(session('success'))

                    <div
                        id="toast-success"
                        class="toast"
                    >

                        <i class="fas fa-check-circle"></i>

                        {{ session('success') }}

                    </div>

                @endif


                <!-- =================================================
                     ERROS
                ================================================== -->

                @if ($errors->any())

                    <div class="error-box">

                        <strong>

                            <i class="fas fa-exclamation-triangle"></i>

                            Verifique os seguintes erros:

                        </strong>

                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- =================================================
                     FORMULÁRIO
                ================================================== -->

                <form
                    action="{{ route('eleves.store') }}"
                    method="POST"
                    class="student-form"
                >

                    @csrf


                    <!-- =================================================
                         LINHA 1
                    ================================================== -->

                    <div class="form-row">


                        <!-- MATRÍCULA -->

                        <div class="form-group">

                            <label for="matricula">

                                Matrícula

                            </label>

                            <input
                                type="text"
                                name="matricula"
                                id="matricula"
                                class="form-control matricula-readonly"
                                value="{{ $proximaMatricula ?? 'CSM001' }}"
                                readonly
                            >

                        </div>


                        <!-- NOME -->

                        <div class="form-group">

                            <label for="nome">

                                Nome

                                <span style="color:red;">
                                    *
                                </span>

                            </label>

                            <input
                                type="text"
                                name="nome"
                                id="nome"
                                class="form-control"
                                value="{{ old('nome') }}"
                                placeholder="Nome do aluno"
                                required
                                autofocus
                            >

                        </div>

                    </div>


                    <!-- =================================================
                         LINHA 2
                    ================================================== -->

                    <div class="form-row">


                        <!-- APELIDO -->

                        <div class="form-group">

                            <label for="apelido">

                                Apelido

                                <span style="color:red;">
                                    *
                                </span>

                            </label>

                            <input
                                type="text"
                                name="apelido"
                                id="apelido"
                                class="form-control"
                                value="{{ old('apelido') }}"
                                placeholder="Apelido do aluno"
                                required
                            >

                        </div>


                        <!-- DATA NASCIMENTO -->

                        <div class="form-group">

                            <label for="data_nascimento">

                                Data de Nascimento

                                <span style="color:red;">
                                    *
                                </span>

                            </label>

                            <input
                                type="date"
                                name="data_nascimento"
                                id="data_nascimento"
                                class="form-control"
                                value="{{ old('data_nascimento') }}"
                                required
                            >

                        </div>

                    </div>


                    <!-- =================================================
                         LINHA 3
                    ================================================== -->

                    <div class="form-row">


                        <!-- SEXO -->

                        <div class="form-group">

                            <label for="sexo">

                                Sexo

                                <span style="color:red;">
                                    *
                                </span>

                            </label>

                            <select
                                name="sexo"
                                id="sexo"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    -- Selecionar sexo --
                                </option>

                                <option
                                    value="Masculino"
                                    {{ old('sexo') == 'Masculino' ? 'selected' : '' }}
                                >
                                    Masculino
                                </option>

                                <option
                                    value="Feminino"
                                    {{ old('sexo') == 'Feminino' ? 'selected' : '' }}
                                >
                                    Feminino
                                </option>

                            </select>

                        </div>


                        <!-- ENDEREÇO -->

                        <div class="form-group">

                            <label for="endereco">

                                Endereço

                            </label>

                            <input
                                type="text"
                                name="endereco"
                                id="endereco"
                                class="form-control"
                                value="{{ old('endereco') }}"
                                placeholder="Endereço do aluno"
                            >

                        </div>

                    </div>


                    <!-- =================================================
                         LINHA 4
                    ================================================== -->

                    <div class="form-row">


                        <!-- TELEFONE -->

                        <div class="form-group">

                            <label for="telefone">

                                Telefone

                            </label>

                            <input
                                type="text"
                                name="telefone"
                                id="telefone"
                                class="form-control"
                                value="{{ old('telefone') }}"
                                placeholder="Telefone"
                            >

                        </div>


                        <!-- ENCARREGADO -->

                        <div class="form-group">

                            <label for="parent_id">

                                Encarregado

                                <span style="color:red;">
                                    *
                                </span>

                            </label>

                            <select
                                name="parent_id"
                                id="parent_id"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    -- Selecionar encarregado --
                                </option>

                                @foreach($parents as $parent)

                                    <option
                                        value="{{ $parent->id }}"
                                        {{ old('parent_id') == $parent->id ? 'selected' : '' }}
                                    >

                                        {{ $parent->firstname }}
                                        {{ $parent->lastname }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    <!-- =================================================
                         BOTÕES
                    ================================================== -->

                    <div class="form-actions">


                        <button
                            type="submit"
                            class="btn-save"
                        >

                            <i class="fas fa-save"></i>

                            Cadastrar Aluno

                        </button>


                        <a
                            href="{{ route('eleves.listeleves') }}"
                            class="btn-cancel"
                        >

                            <i class="fas fa-times"></i>

                            Cancelar

                        </a>

                    </div>


                </form>

            </div>

        </div>

    </fieldset>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


/* =========================================================
   MENU SIDEBAR
========================================================= */

function toggleMenu()
{

    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("overlay");


    if (!sidebar) {

        return;

    }


    sidebar.classList.toggle("open");


    if (overlay) {

        overlay.classList.toggle("active");

    }

}


/* =========================================================
   SUBMENU
========================================================= */

function toggleSubmenu(element)
{

    if (!element) {

        return;

    }


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


/* =========================================================
   FECHAR SIDEBAR PELO OVERLAY
========================================================= */

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
   REMOVER TOAST
========================================================= */

setTimeout(
    function ()
    {

        const toast =
            document.getElementById(
                "toast-success"
            );


        if (toast) {

            toast.remove();

        }

    },
    5500
);

</script>


</body>

</html>