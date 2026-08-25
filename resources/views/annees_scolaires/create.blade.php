<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Ano Letivo - CSM-SmartSchool</title>

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

    <!-- Navbar -->

    <div class="navbar">

        <div class="menu-toggle" onclick="toggleMenu()">
            ☰
        </div>

        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="CSM-SmartSchool">
        </div>

        <div class="search">
            <input type="hidden" placeholder="Pesquisar...">
        </div>

    </div>


    <!-- Sidebar -->

    @include('partials.sidebargestacad')


    <!-- Conteúdo principal -->

    <div class="main-content">

        <fieldset style="border-radius:8px;border:2px solid blue;">

            <legend style="text-align:center;">

                <h3
                    style="text-align:center; color:blue;">
                    <i class="fas fa-calendar-alt"></i>
                    Novo Ano Letivo
                </h3>
            </legend>


            <div class="container">

                <!-- Imagem -->

                <div class="form-image">
                    <img src="{{ asset('img/books.png') }}" alt="Ano Letivo" style="height:70px; margin-left:40px;">

                </div>


                <!-- Formulário -->

                <div class="form-container">

                    <form action="{{ route('annees-scolaires.store') }}" method="POST">

                        @csrf
                        <!-- Erros -->
                        @if ($errors->any())

                            <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:8px; border:1px solid #f5c6cb;">

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
                             ANO LETIVO + DATAS
                        ====================================================== -->

                        <div
                            style="display:grid; grid-template-columns: 1.2fr 1fr 1fr; gap:20px; align-items:end;">


                            <!-- Ano Letivo -->

                            <div>

                                <label for="nome" class="form-label" >

                                    <i class="fas fa-calendar"></i>

                                    Ano Letivo

                                    <span style="color:red;">
                                        *
                                    </span>

                                </label>

                                <input type="text" id="nome" name="nome" class="form-control" 
                                    value="{{ old('nome') }}"
                                    placeholder="Ex.: 2026/2027"
                                    maxlength="20"
                                    required
                                >

                            </div>


                            <!-- Data de início -->

                            <div>

                                <label
                                    for="data_inicio"
                                    class="form-label"
                                >

                                    <i class="fas fa-calendar-check"></i>

                                    Data de início

                                    <span style="color:red;">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="date"
                                    id="data_inicio"
                                    name="data_inicio"
                                    class="form-control"
                                    value="{{ old('data_inicio') }}"
                                    required
                                >

                            </div>


                            <!-- Data de fim -->

                            <div>

                                <label
                                    for="data_fim"
                                    class="form-label"
                                >

                                    <i class="fas fa-calendar-times"></i>

                                    Data de fim

                                    <span style="color:red;">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="date"
                                    id="data_fim"
                                    name="data_fim"
                                    class="form-control"
                                    value="{{ old('data_fim') }}"
                                    required
                                >

                            </div>

                        </div>


                        <!-- =====================================================
                             ESTADO
                        ====================================================== -->

                        <div
                            style="
                                margin-top:25px;
                                padding:15px;
                                background:#f8f9fa;
                                border:1px solid #ddd;
                                border-radius:8px;
                            "
                        >

                            <label
                                for="ativo"
                                style="
                                    display:flex;
                                    align-items:center;
                                    gap:10px;
                                    cursor:pointer;
                                "
                            >

                                <input
                                    type="checkbox"
                                    name="ativo"
                                    value="1"
                                    id="ativo"
                                    {{ old('ativo') ? 'checked' : '' }}
                                    style="
                                        width:18px;
                                        height:18px;
                                    "
                                >

                                <div>

                                    <strong>
                                        Definir como ano letivo ativo
                                    </strong>

                                    <div
                                        style="
                                            color:#777;
                                            font-size:13px;
                                            margin-top:3px;
                                        "
                                    >

                                        Este será o ano utilizado
                                        para novas inscrições.

                                    </div>

                                </div>

                            </label>

                        </div>


                        <!-- =====================================================
                             INFORMAÇÃO
                        ====================================================== -->

                        <div
                            style="
                                margin-top:15px;
                                padding:12px;
                                background:#e7f3ff;
                                border-left:4px solid #007bff;
                                border-radius:5px;
                                color:#245;
                                font-size:14px;
                            "
                        >

                            <i class="fas fa-info-circle"></i>

                            <strong>Nota:</strong>

                            Apenas um ano letivo pode estar ativo
                            de cada vez.

                        </div>


                        <!-- =====================================================
                             BOTÕES
                        ====================================================== -->

                        <div
                            style="
                                display:flex;
                                gap:10px;
                                margin-top:25px;
                            "
                        >

                            <button
                                type="submit"
                                class="mt-3"
                            >

                                <i class="fas fa-save"></i>

                                Guardar

                            </button>


                            <a
                                href="{{ route('annees-scolaires.index') }}"
                                style="
                                    display:inline-block;
                                    margin-top:15px;
                                    padding:10px 20px;
                                    background:#6c757d;
                                    color:white;
                                    text-decoration:none;
                                    border-radius:5px;
                                "
                            >

                                <i class="fas fa-arrow-left"></i>

                                Voltar

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </fieldset>

    </div>


    <!-- Script do menu -->

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