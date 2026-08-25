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
            "
        >

            <legend style="text-align: center;">

                <h3
                    style="
                        text-align: center;
                        color: blue;
                    "
                >
                    EDITER ELEVE
                </h3>

            </legend>


            <div class="container">


                <!-- =================================================
                     IMAGEM
                ================================================== -->

                <div class="form-image">

                    <img
                        src="{{ asset('img/modif01.png') }}"
                        alt="Modifier élève"
                        style="
                            height: 50px;
                            margin-left: 40px;
                        "
                    >

                </div>


                <!-- =================================================
                     FORMULÁRIO
                ================================================== -->

                <div class="form-container">


                    <!-- =============================================
                         SUCESSO
                    ============================================== -->

                    @if (session('success'))

                        <div
                            style="
                                color: green;
                                background: #e8f5e9;
                                padding: 10px;
                                margin-bottom: 15px;
                                border-radius: 5px;
                            "
                        >
                            {{ session('success') }}
                        </div>

                    @endif


                    <!-- =============================================
                         ERROS
                    ============================================== -->

                    @if ($errors->any())

                        <div
                            style="
                                color: red;
                                background: #ffebee;
                                padding: 10px;
                                margin-bottom: 15px;
                                border-radius: 5px;
                            "
                        >

                            <ul>

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <!-- =============================================
                         FORM
                    ============================================== -->

                    <form
                        action="{{ route('eleves.update', $eleve) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <!-- =========================================
                             MATRÍCULA
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="matricula"
                                class="form-label"
                            >
                                Matrícula
                            </label>

                            <input
                                type="text"
                                id="matricula"
                                class="form-control"
                                name="matricula"
                                value="{{ old('matricula', $eleve->matricula) }}"
                                required
                            >

                        </div>


                        <!-- =========================================
                             NOME
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="nome"
                                class="form-label"
                            >
                                Nome
                            </label>

                            <input
                                type="text"
                                id="nome"
                                class="form-control"
                                name="nome"
                                value="{{ old('nome', $eleve->nome) }}"
                                required
                            >

                        </div>


                        <!-- =========================================
                             APELIDO
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="apelido"
                                class="form-label"
                            >
                                Apelido
                            </label>

                            <input
                                type="text"
                                id="apelido"
                                class="form-control"
                                name="apelido"
                                value="{{ old('apelido', $eleve->apelido) }}"
                                required
                            >

                        </div>


                        <!-- =========================================
                             DATA DE NASCIMENTO
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="data_nascimento"
                                class="form-label"
                            >
                                Data de Nascimento
                            </label>

                            <input
                                type="date"
                                id="data_nascimento"
                                class="form-control"
                                name="data_nascimento"
                                value="{{ old('data_nascimento', $eleve->data_nascimento) }}"
                                required
                            >

                        </div>


                        <!-- =========================================
                             SEXO
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="sexo"
                                class="form-label"
                            >
                                Sexo
                            </label>

                            <select
                                id="sexo"
                                class="form-control"
                                name="sexo"
                                required
                            >

                                <option value="">
                                    Choisir...
                                </option>

                                <option
                                    value="Masculino"
                                    {{ old('sexo', $eleve->sexo) == 'Masculino' ? 'selected' : '' }}
                                >
                                    Masculino
                                </option>

                                <option
                                    value="Feminino"
                                    {{ old('sexo', $eleve->sexo) == 'Feminino' ? 'selected' : '' }}
                                >
                                    Feminino
                                </option>

                            </select>

                        </div>


                        <!-- =========================================
                             TELEFONE
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="telefone"
                                class="form-label"
                            >
                                Telefone
                            </label>

                            <input
                                type="text"
                                id="telefone"
                                class="form-control"
                                name="telefone"
                                value="{{ old('telefone', $eleve->telefone) }}"
                            >

                        </div>


                        <!-- =========================================
                             ENDEREÇO
                        ========================================== -->

                        <div class="col-md-6">

                            <label
                                for="endereco"
                                class="form-label"
                            >
                                Endereço
                            </label>

                            <input
                                type="text"
                                id="endereco"
                                class="form-control"
                                name="endereco"
                                value="{{ old('endereco', $eleve->endereco) }}"
                            >

                        </div>


                        <!-- =========================================
     ENCARREGADO DE EDUCAÇÃO
========================================== -->

<div class="col-md-6">

    <label
        for="parent_id"
        class="form-label"
    >
        Encarregado de Educação
    </label>

    <select
        id="parent_id"
        class="form-control"
        name="parent_id"
    >

        <option value="">
            Choisir...
        </option>

        @foreach ($parents as $parent)

            <option
                value="{{ $parent->id }}"
                {{ old('parent_id', $eleve->parent_id) == $parent->id ? 'selected' : '' }}
            >
                {{ $parent->firstname }}
                {{ $parent->lastname }}
            </option>

        @endforeach

    </select>

</div>



                        <!-- =========================================
                             DESCRIÇÃO
                        ========================================== -->

                        <div class="col-md-12">

                            <label
                                for="description"
                                class="form-label"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                class="form-control"
                                name="description"
                                rows="5"
                            >{{ old('description', $eleve->description) }}</textarea>

                        </div>


                        <!-- =========================================
                             BOTÕES
                        ========================================== -->

                        <div
                            style="
                                margin-top: 20px;
                                display: flex;
                                gap: 10px;
                            "
                        >

                            <button
                                type="submit"
                                class="mt-3"
                            >
                                Actualiser
                            </button>


                            <a
                                href="{{ route('eleves.show', $eleve) }}"
                                style="
                                    display: inline-block;
                                    padding: 10px 20px;
                                    background: #777;
                                    color: white;
                                    text-decoration: none;
                                    border-radius: 5px;
                                "
                            >
                                Annuler
                            </a>

                        </div>

                    </form>

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