<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    >
    <link rel="icon" href="{{ asset('img/books.png') }}">

    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #38a169;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 9999;
            animation: slideIn 0.5s, fadeOut 0.5s 3.5s forwards;
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
                display: none;
            }
        }

        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        .permission-table {
            width: 100%;
            border-collapse: collapse;
        }

        .permission-table input,
        .permission-table textarea,
        .permission-table select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .permission-table select {
            background-color: white;
            cursor: pointer;
        }

        .btn-group-center {
            text-align: center;
            margin-top: 10px;
        }

        .action-btn {
            padding: 8px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        .btn-submit {
            background-color: #1c359d;
            color: white;
        }

        .btn-submit:hover {
            background-color: #142a7a;
        }

        .security-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .security-warning i {
            margin-right: 8px;
        }
    </style>
</head>

<body>

<div id="overlay" class="overlay"></div>

<!-- NAVBAR -->
<div class="navbar">

    <div class="menu-toggle" onclick="toggleMenu()">
        ☰
    </div>

    <div class="logo">
        <img
            src="{{ asset('img/logo.png') }}"
            alt="Logo"
        >
    </div>

    <div class="search">
        <input
            type="text"
            placeholder="Pesquisar..."
        >
    </div>

</div>


<!-- SIDEBAR -->
@include('partials.sidebargestacad')


<!-- CONTEÚDO PRINCIPAL -->
<div class="main-content">

    <fieldset style="border-radius:8px; border:2px solid blue">

        <legend style="text-align:center">
            <h3 style="color:blue">
                EDITER PROFESSEUR
            </h3>
        </legend>

        <div class="container">

            <!-- ÍCONE -->
            <div style="text-align:center; margin-bottom:15px;">
                <img
                    src="{{ asset('img/modif01.png') }}"
                    alt="Editar"
                    style="height:50px;"
                >
            </div>


            <!-- MENSAGEM DE SUCESSO -->
            @if(session('success'))

                <div class="toast">
                    {{ session('success') }}
                </div>

            @endif


            <!-- ERROS -->
            @if($errors->any())

                <div class="error-messages">

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- AVISO DE SEGURANÇA -->
            <div class="security-warning">

                <i class="fas fa-shield-alt"></i>

                <strong>Sécurité :</strong>

                Les fonctions
                <strong>Admin</strong>
                et
                <strong>Direction</strong>
                ne peuvent pas être attribuées depuis cette page.

            </div>


            <!-- FORMULÁRIO -->
            <form
                action="{{ route('professors.update', ['professor' => $professor->id]) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <table class="permission-table">

                    <thead>

                        <tr>

                            <th>
                                ATTRIBUT
                            </th>

                            <th>
                                VALEUR
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <!-- NOME -->
                        <tr>

                            <td>
                                <strong>Nom</strong>
                            </td>

                            <td>

                                <input
                                    type="text"
                                    name="firstname"
                                    value="{{ old('firstname', $professor->firstname) }}"
                                    required
                                >

                            </td>

                        </tr>


                        <!-- PRÉNOM -->
                        <tr>

                            <td>
                                <strong>Prénom</strong>
                            </td>

                            <td>

                                <input
                                    type="text"
                                    name="lastname"
                                    value="{{ old('lastname', $professor->lastname) }}"
                                    required
                                >

                            </td>

                        </tr>


                        <!-- EMAIL -->
                        <tr>

                            <td>
                                <strong>Email</strong>
                            </td>

                            <td>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $professor->email) }}"
                                    required
                                >

                            </td>

                        </tr>


                        <!-- TELEPHONE -->
                        <tr>

                            <td>
                                <strong>Téléphone</strong>
                            </td>

                            <td>

                                <input
                                    type="text"
                                    name="telephone"
                                    value="{{ old('telephone', $professor->telephone) }}"
                                >

                            </td>

                        </tr>


                        <!-- ADRESSE -->
                        <tr>

                            <td>
                                <strong>Adresse</strong>
                            </td>

                            <td>

                                <textarea
                                    name="address"
                                    rows="3"
                                >{{ old('address', $professor->address) }}</textarea>

                            </td>

                        </tr>


                        <!-- FUNCTION -->
                        <tr>

                            <td>
                                <strong>Function</strong>
                            </td>

                            <td>

                                <select
                                    name="function"
                                    required
                                >

                                    <option
                                        value="Professeur"
                                        {{ old('function', $professor->function) == 'Professeur' ? 'selected' : '' }}
                                    >
                                        Professeur
                                    </option>

                                    <option
                                        value="Parent"
                                        {{ old('function', $professor->function) == 'Parent' ? 'selected' : '' }}
                                    >
                                        Parent
                                    </option>

                                </select>

                            </td>

                        </tr>


                        <!-- BOTÕES -->
                        <tr>

                            <td colspan="2">

                                <div class="btn-group-center">

                                    <button
                                        type="reset"
                                        class="action-btn btn-cancel"
                                    >
                                        Annuler
                                    </button>

                                    <button
                                        type="submit"
                                        class="action-btn btn-submit"
                                    >
                                        Actualiser
                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </form>

        </div>

    </fieldset>

</div>


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


    document.addEventListener("click", function(event) {

        const sidebar =
            document.getElementById("sidebar");

        const toggleBtn =
            document.querySelector(".menu-toggle");

        const overlay =
            document.getElementById("overlay");

        if (
            sidebar &&
            toggleBtn &&
            !sidebar.contains(event.target) &&
            !toggleBtn.contains(event.target)
        ) {

            sidebar.classList.remove("open");

            if (overlay) {
                overlay.classList.remove("active");
            }

        }

    });


    function toggleSubmenu(element, event) {

        if (event) {
            event.preventDefault();
        }

        element.classList.toggle("open");

        const submenu =
            element.nextElementSibling;

        if (submenu) {

            submenu.style.display =
                submenu.style.display === "flex"
                    ? "none"
                    : "flex";

            if (submenu.style.display === "flex") {

                submenu.style.flexDirection =
                    "column";

            }

        }

    }

</script>

</body>
</html>