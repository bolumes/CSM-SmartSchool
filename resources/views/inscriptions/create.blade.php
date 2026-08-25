<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Nova Inscrição - CSM-SmartSchool</title>

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

        /* =========================================================
           ESTRUTURA PRINCIPAL
        ========================================================= */

        .main-content {
            width: 100%;
            box-sizing: border-box;
        }

        .main-content > fieldset {
            width: 100%;
            max-width: 1250px;
            margin: 20px auto;
            box-sizing: border-box;
        }

        .inscription-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            box-sizing: border-box;
            padding: 25px;
        }

        .form-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }


        /* =========================================================
           ERROS
        ========================================================= */

        .error-box {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 8px 0 0 20px;
            padding: 0;
        }


        /* =========================================================
           STEPS
        ========================================================= */

        .steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
        }

        .step {
            display: flex;
            align-items: center;
            color: #999;
            font-size: 14px;
            font-weight: 500;
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #ddd;
            color: #666;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .step.active,
        .step.completed {
            color: #0b5ed7;
            font-weight: 600;
        }

        .step.active .step-number,
        .step.completed .step-number {
            background: #0b5ed7;
            color: white;
        }

        .step-line {
            width: 60px;
            height: 2px;
            background: #ddd;
            margin: 0 10px;
        }


        /* =========================================================
           SEÇÕES
        ========================================================= */

        .form-section {
            border: 1px solid #ddd;
            border-radius: 9px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fafafa;
        }

        .section-title {
            color: #0b5ed7;
            font-size: 17px;
            font-weight: bold;
            padding-bottom: 12px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }


        /* =========================================================
           INFO
        ========================================================= */

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #007bff;
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 20px;
            color: #245;
            font-size: 14px;
            line-height: 1.5;
        }


        /* =========================================================
           FORMULÁRIO
        ========================================================= */

        .form-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .form-group {
            min-width: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #333;
        }

        .form-label i {
            color: #0b5ed7;
            margin-right: 5px;
        }

        .required {
            color: red;
        }

        .form-control {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            transition: .2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #0b5ed7;
            box-shadow: 0 0 4px rgba(11, 94, 215, .20);
        }

        .form-control:disabled {
            background: #eeeeee;
            color: #777;
            cursor: not-allowed;
        }


        /* =========================================================
           PESQUISA
        ========================================================= */

        .search-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .search-separator {
            text-align: center;
            color: #888;
            margin: 20px 0;
            font-size: 13px;
        }


        /* =========================================================
           BOTÕES
        ========================================================= */

        .btn {
            border: none;
            padding: 10px 18px;
            min-height: 42px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 14px;
            transition: .2s;
            box-sizing: border-box;
        }

        .btn:hover {
            opacity: .90;
        }

        .btn-primary {
            background: #0b5ed7;
            color: white;
        }

        .btn-success {
            background: #198754;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn:disabled {
            opacity: .55;
            cursor: not-allowed;
        }


        /* =========================================================
           RESULTADOS
        ========================================================= */

        .student-result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: white;
        }

        .student-result.success {
            border-color: #75b798;
            background: #f0fff4;
        }

        .student-result.error {
            border-color: #ea868f;
            background: #fff3f3;
            color: #a00;
        }

        .student-result.info {
            border-color: #90caf9;
            background: #eef7ff;
            color: #164b78;
        }


        /* =========================================================
           CARD DO ALUNO
        ========================================================= */

        .student-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 14px;
            margin-top: 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            background: #fff;
            transition: .2s;
        }

        .student-card:hover {
            border-color: #0b5ed7;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .student-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .student-meta {
            color: #666;
            font-size: 13px;
        }


        /* =========================================================
           ALUNO SELECIONADO
        ========================================================= */

        .selected-student {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .selected-student-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #0b5ed7;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .selected-student-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }


        /* =========================================================
           RESUMO
        ========================================================= */

        .summary {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .summary-item {
            background: #f7f7f7;
            border-radius: 6px;
            padding: 12px;
        }

        .summary-item strong {
            display: block;
            color: #666;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .summary-item span {
            color: #333;
            font-weight: 600;
        }


        /* =========================================================
           BOTÕES FINAIS
        ========================================================= */

        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media(max-width: 900px) {

            .main-content > fieldset {
                margin: 10px;
                width: calc(100% - 20px);
            }

            .inscription-container {
                padding: 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

        }


        @media(max-width: 600px) {

            .main-content > fieldset {
                margin: 5px;
                width: calc(100% - 10px);
            }

            .inscription-container {
                padding: 10px;
            }

            .search-row {
                grid-template-columns: 1fr;
            }

            .search-row .btn {
                width: 100%;
            }

            .student-card,
            .selected-student {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .button-container {
                flex-direction: column;
            }

            .button-container .btn {
                width: 100%;
            }

            .steps {
                transform: scale(.85);
            }

            .step-line {
                width: 25px;
            }

        }

    </style>

</head>


<body>


    <!-- NAVBAR -->

    <div class="navbar">

        <div class="menu-toggle" onclick="toggleMenu()">
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


    <!-- SIDEBAR -->

    @include('partials.sidebargestacad')


    <!-- CONTEÚDO -->

    <div class="main-content">

        <fieldset
            style="
                border-radius:8px;
                border:2px solid #0b5ed7;
            "
        >

            <legend style="text-align:center;">

                <h3
                    style="
                        text-align:center;
                        color:#0b5ed7;
                    "
                >

                    <i class="fas fa-user-plus"></i>

                    Nova Inscrição

                </h3>

            </legend>


            <div class="inscription-container">

                <div class="form-container">


                    <!-- ERROS -->

                    @if($errors->any())

                        <div class="error-box">

                            <strong>

                                <i class="fas fa-exclamation-triangle"></i>

                                Por favor, corrija os seguintes erros:

                            </strong>

                            <ul>

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <!-- ETAPAS -->

                    <div class="steps">

                        <div
                            class="step active"
                            id="step1"
                        >

                            <div class="step-number">
                                1
                            </div>

                            <span style="margin-left:7px;">
                                Aluno
                            </span>

                        </div>


                        <div class="step-line"></div>


                        <div
                            class="step"
                            id="step2"
                        >

                            <div class="step-number">
                                2
                            </div>

                            <span style="margin-left:7px;">
                                Inscrição
                            </span>

                        </div>


                        <div class="step-line"></div>


                        <div
                            class="step"
                            id="step3"
                        >

                            <div class="step-number">
                                3
                            </div>

                            <span style="margin-left:7px;">
                                Confirmação
                            </span>

                        </div>

                    </div>


                    <!-- FORM -->

                    <form
                        action="{{ route('inscriptions.store') }}"
                        method="POST"
                        id="inscriptionForm"
                    >

                        @csrf


                        <!-- 1. ALUNO -->

                        <div
                            class="form-section"
                            id="studentSection"
                        >

                            <div class="section-title">

                                <i class="fas fa-user-graduate"></i>

                                1. Selecionar aluno

                            </div>


                            <div class="info-box">

                                <i class="fas fa-info-circle"></i>

                                Pesquise o aluno através da sua
                                <strong>matrícula</strong> ou procure
                                pelos alunos de uma determinada
                                <strong>classe</strong>.

                            </div>


                            <div class="search-row">

                                <div class="form-group">

                                    <label
                                        for="matricula"
                                        class="form-label"
                                    >

                                        <i class="fas fa-id-card"></i>

                                        Matrícula

                                    </label>

                                    <input
                                        type="text"
                                        id="matricula"
                                        class="form-control"
                                        placeholder="Digite a matrícula do aluno"
                                        autocomplete="off"
                                    >

                                </div>


                                <button
                                    type="button"
                                    id="searchMatriculaBtn"
                                    class="btn btn-primary"
                                >

                                    <i class="fas fa-search"></i>

                                    Pesquisar

                                </button>

                            </div>


                            <div class="search-separator">

                                — ou procure pela classe —

                            </div>


                            <div class="form-row">

                                <div class="form-group">

                                    <label
                                        for="search_level"
                                        class="form-label"
                                    >

                                        <i class="fas fa-layer-group"></i>

                                        Nível

                                    </label>


                                    <select
                                        id="search_level"
                                        class="form-control"
                                    >

                                        <option value="">
                                            -- Selecione o nível --
                                        </option>

                                        @foreach($levels as $level)

                                            <option value="{{ $level }}">
                                                {{ $level }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="search_classe_id"
                                        class="form-label"
                                    >

                                        <i class="fas fa-school"></i>

                                        Classe

                                    </label>


                                    <select
                                        id="search_classe_id"
                                        class="form-control"
                                        disabled
                                    >

                                        <option value="">
                                            -- Selecione primeiro o nível --
                                        </option>

                                    </select>

                                </div>


                                <div
                                    class="form-group"
                                    style="
                                        display:flex;
                                        align-items:flex-end;
                                    "
                                >

                                    <button
                                        type="button"
                                        id="searchStudentsBtn"
                                        class="btn btn-primary"
                                        disabled
                                        style="width:100%;"
                                    >

                                        <i class="fas fa-users"></i>

                                        Procurar alunos

                                    </button>

                                </div>

                            </div>


                            <div
                                id="studentResult"
                                style="display:none;"
                            ></div>


                            <input
                                type="hidden"
                                name="eleve_id"
                                id="eleve_id"
                                value=""
                            >

                        </div>


                        <!-- 2. INSCRIÇÃO -->

                        <div
                            id="inscriptionSection"
                            class="form-section"
                            style="display:none;"
                        >

                            <div class="section-title">

                                <i class="fas fa-school"></i>

                                2. Dados da inscrição

                            </div>


                            <div
                                id="selectedStudent"
                                class="student-result success"
                            >

                                <div class="selected-student">

                                    <div class="selected-student-info">

                                        <div class="student-avatar">

                                            <i class="fas fa-user"></i>

                                        </div>


                                        <div>

                                            <div
                                                class="selected-student-name"
                                                id="selectedStudentName"
                                            >
                                                —
                                            </div>


                                            <div class="student-meta">

                                                Matrícula:

                                                <strong
                                                    id="selectedStudentMatricula"
                                                >
                                                    —
                                                </strong>

                                            </div>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        id="changeStudentBtn"
                                        class="btn btn-secondary"
                                    >

                                        <i class="fas fa-exchange-alt"></i>

                                        Alterar aluno

                                    </button>

                                </div>

                            </div>


                            <div
                                class="form-row"
                                style="margin-top:20px;"
                            >

                                <div class="form-group">

                                    <label
                                        for="annee_scolaire_id"
                                        class="form-label"
                                    >

                                        <i class="fas fa-calendar-alt"></i>

                                        Ano letivo

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="annee_scolaire_id"
                                        id="annee_scolaire_id"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">
                                            -- Selecione o ano letivo --
                                        </option>

                                        @foreach($anneesScolaires as $annee)

                                            <option
                                                value="{{ $annee->id }}"
                                                {{ old('annee_scolaire_id') == $annee->id ? 'selected' : '' }}
                                            >

                                                {{ $annee->nome }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="level"
                                        class="form-label"
                                    >

                                        <i class="fas fa-layer-group"></i>

                                        Nível

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="level"
                                        id="level"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">
                                            -- Selecione o nível --
                                        </option>

                                        @foreach($levels as $level)

                                            <option
                                                value="{{ $level }}"
                                                {{ old('level') == $level ? 'selected' : '' }}
                                            >

                                                {{ $level }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="classe_id"
                                        class="form-label"
                                    >

                                        <i class="fas fa-chalkboard"></i>

                                        Classe

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="classe_id"
                                        id="classe_id"
                                        class="form-control"
                                        disabled
                                        required
                                    >

                                        <option value="">
                                            -- Selecione primeiro o nível --
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        <!-- 3. CONFIRMAÇÃO -->

                        <div
                            id="summarySection"
                            class="form-section"
                            style="display:none;"
                        >

                            <div class="section-title">

                                <i class="fas fa-check-circle"></i>

                                3. Confirmação da inscrição

                            </div>


                            <div class="info-box">

                                <i class="fas fa-info-circle"></i>

                                Verifique cuidadosamente os dados abaixo
                                antes de concluir a inscrição.

                            </div>


                            <div class="summary">

                                <div class="summary-grid">

                                    <div class="summary-item">

                                        <strong>
                                            Aluno
                                        </strong>

                                        <span id="summaryStudent">
                                            —
                                        </span>

                                    </div>


                                    <div class="summary-item">

                                        <strong>
                                            Matrícula
                                        </strong>

                                        <span id="summaryMatricula">
                                            —
                                        </span>

                                    </div>


                                    <div class="summary-item">

                                        <strong>
                                            Ano letivo
                                        </strong>

                                        <span id="summaryYear">
                                            —
                                        </span>

                                    </div>


                                    <div class="summary-item">

                                        <strong>
                                            Nível
                                        </strong>

                                        <span id="summaryLevel">
                                            —
                                        </span>

                                    </div>


                                    <div class="summary-item">

                                        <strong>
                                            Classe
                                        </strong>

                                        <span id="summaryClass">
                                            —
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- BOTÕES -->

                        <div class="button-container">

                            <a
                                href="{{ route('inscriptions.index') }}"
                                class="btn btn-secondary"
                            >

                                <i class="fas fa-arrow-left"></i>

                                Voltar

                            </a>


                            <button
                                type="submit"
                                id="saveBtn"
                                class="btn btn-primary"
                                disabled
                            >

                                <i class="fas fa-save"></i>

                                Concluir inscrição

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </fieldset>

    </div>


    <!-- SCRIPTS -->

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


        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const studentResult =
                    document.getElementById('studentResult');

                const eleveId =
                    document.getElementById('eleve_id');

                const inscriptionSection =
                    document.getElementById('inscriptionSection');

                const summarySection =
                    document.getElementById('summarySection');

                const saveBtn =
                    document.getElementById('saveBtn');

                const inscriptionForm =
                    document.getElementById('inscriptionForm');

                const searchLevel =
                    document.getElementById('search_level');

                const searchClasse =
                    document.getElementById('search_classe_id');

                const searchStudentsBtn =
                    document.getElementById('searchStudentsBtn');

                const level =
                    document.getElementById('level');

                const classe =
                    document.getElementById('classe_id');

                const changeStudentBtn =
                    document.getElementById('changeStudentBtn');


                document
                    .getElementById('searchMatriculaBtn')
                    .addEventListener(
                        'click',
                        function () {

                            const matricula =
                                document
                                    .getElementById('matricula')
                                    .value
                                    .trim();

                            if (!matricula) {

                                showError(
                                    'Digite a matrícula do aluno.'
                                );

                                return;
                            }

                            const button = this;

                            setButtonLoading(
                                button,
                                'Procurando...'
                            );

                            const url =
                                "{{ route('inscriptions.student-by-matricula') }}" +
                                "?matricula=" +
                                encodeURIComponent(matricula);

                            fetch(url, {

                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }

                            })

                            .then(function (response) {

                                return response.json()
                                    .then(function (data) {

                                        return {
                                            ok: response.ok,
                                            data: data
                                        };

                                    });

                            })

                            .then(function (result) {

                                if (
                                    !result.ok ||
                                    !result.data.success
                                ) {

                                    showError(
                                        result.data.message ||
                                        'Aluno não encontrado.'
                                    );

                                    return;
                                }

                                selectStudent(
                                    result.data.student
                                );

                            })

                            .catch(function () {

                                showError(
                                    'Ocorreu um erro ao procurar o aluno.'
                                );

                            })

                            .finally(function () {

                                resetButton(
                                    button,
                                    '<i class="fas fa-search"></i> Pesquisar'
                                );

                            });

                        }
                    );


                document
                    .getElementById('matricula')
                    .addEventListener(
                        'keydown',
                        function (event) {

                            if (event.key === 'Enter') {

                                event.preventDefault();

                                document
                                    .getElementById('searchMatriculaBtn')
                                    .click();

                            }

                        }
                    );


                searchLevel.addEventListener(
                    'change',
                    function () {

                        const selectedLevel =
                            this.value;

                        searchClasse.disabled = true;

                        searchStudentsBtn.disabled = true;

                        if (!selectedLevel) {

                            searchClasse.innerHTML =
                                '<option value="">-- Selecione primeiro o nível --</option>';

                            return;
                        }

                        searchClasse.innerHTML =
                            '<option value="">Carregando classes...</option>';

                        loadClasses(
                            selectedLevel,
                            searchClasse,
                            function () {

                                searchClasse.disabled =
                                    false;

                            },
                            function () {

                                searchClasse.innerHTML =
                                    '<option value="">Erro ao carregar classes</option>';

                            }
                        );

                    }
                );


                searchClasse.addEventListener(
                    'change',
                    function () {

                        searchStudentsBtn.disabled =
                            !this.value;

                    }
                );


                searchStudentsBtn.addEventListener(
                    'click',
                    function () {

                        const classeId =
                            searchClasse.value;

                        if (!classeId) {

                            showError(
                                'Selecione uma classe.'
                            );

                            return;
                        }

                        const button = this;

                        setButtonLoading(
                            button,
                            'Procurando...'
                        );

                        const url =
                            "{{ url('/inscriptions/students') }}/" +
                            encodeURIComponent(classeId);

                        fetch(url, {

                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }

                        })

                        .then(function (response) {

                            if (!response.ok) {
                                throw new Error();
                            }

                            return response.json();

                        })

                        .then(function (students) {

                            renderStudents(
                                students
                            );

                        })

                        .catch(function () {

                            showError(
                                'Ocorreu um erro ao procurar os alunos.'
                            );

                        })

                        .finally(function () {

                            resetButton(
                                button,
                                '<i class="fas fa-users"></i> Procurar alunos'
                            );

                        });

                    }
                );


                function renderStudents(students) {

                    studentResult.style.display =
                        'block';

                    studentResult.className =
                        'student-result';

                    if (
                        !students ||
                        !students.length
                    ) {

                        studentResult.innerHTML = `

                            <div class="info-box"
                                 style="margin:0;">

                                <i class="fas fa-info-circle"></i>

                                Nenhum aluno encontrado nesta classe.

                            </div>

                        `;

                        return;
                    }

                    let html = `

                        <strong>

                            <i class="fas fa-users"></i>

                            ${students.length}
                            aluno(s) encontrado(s)

                        </strong>

                    `;

                    students.forEach(function (student) {

                        const fullName =
                            (
                                student.nome ||
                                ''
                            ) +
                            ' ' +
                            (
                                student.apelido ||
                                ''
                            );

                        html += `

                            <div class="student-card">

                                <div>

                                    <div class="student-name">

                                        ${escapeHtml(
                                            fullName.trim()
                                        )}

                                    </div>

                                    <div class="student-meta">

                                        <i class="fas fa-id-card"></i>

                                        Matrícula:

                                        <strong>
                                            ${escapeHtml(
                                                student.matricula || '—'
                                            )}
                                        </strong>

                                    </div>

                                </div>

                                <button
                                    type="button"
                                    class="btn btn-success select-student"
                                    data-id="${escapeHtml(student.id)}"
                                >

                                    <i class="fas fa-check"></i>

                                    Selecionar

                                </button>

                            </div>

                        `;

                    });

                    studentResult.innerHTML =
                        html;

                    studentResult
                        .querySelectorAll('.select-student')
                        .forEach(function (button) {

                            button.addEventListener(
                                'click',
                                function () {

                                    const id =
                                        this.dataset.id;

                                    const student =
                                        students.find(
                                            function (item) {

                                                return String(item.id) ===
                                                    String(id);

                                            }
                                        );

                                    if (student) {

                                        selectStudent(
                                            student
                                        );

                                    }

                                }
                            );

                        });

                }


                function selectStudent(student) {

                    if (!student || !student.id) {

                        showError(
                            'Não foi possível selecionar este aluno.'
                        );

                        return;
                    }

                    const fullName =
                        (
                            student.nome ||
                            ''
                        ) +
                        ' ' +
                        (
                            student.apelido ||
                            ''
                        );

                    const matricula =
                        student.matricula ||
                        '—';

                    eleveId.value =
                        student.id;

                    document.getElementById(
                        'selectedStudentName'
                    ).textContent =
                        fullName.trim();

                    document.getElementById(
                        'selectedStudentMatricula'
                    ).textContent =
                        matricula;

                    studentResult.style.display =
                        'none';

                    studentResult.innerHTML =
                        '';

                    inscriptionSection.style.display =
                        'block';

                    updateSteps(2);

                    updateSummary();

                    inscriptionSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                }


                changeStudentBtn.addEventListener(
                    'click',
                    function () {

                        eleveId.value =
                            '';

                        inscriptionSection.style.display =
                            'none';

                        summarySection.style.display =
                            'none';

                        saveBtn.disabled =
                            true;

                        document.getElementById(
                            'selectedStudentName'
                        ).textContent =
                            '—';

                        document.getElementById(
                            'selectedStudentMatricula'
                        ).textContent =
                            '—';

                        updateSteps(1);

                        document.getElementById(
                            'studentSection'
                        ).scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                    }
                );


                level.addEventListener(
                    'change',
                    function () {

                        const selectedLevel =
                            this.value;

                        classe.disabled =
                            true;

                        classe.innerHTML =
                            '<option value="">Carregando classes...</option>';

                        updateSummary();

                        if (!selectedLevel) {

                            classe.innerHTML =
                                '<option value="">-- Selecione primeiro o nível --</option>';

                            return;
                        }

                        loadClasses(
                            selectedLevel,
                            classe,
                            function () {

                                classe.disabled =
                                    false;

                                updateSummary();

                            },
                            function () {

                                classe.innerHTML =
                                    '<option value="">Erro ao carregar classes</option>';

                            }
                        );

                    }
                );


                classe.addEventListener(
                    'change',
                    function () {

                        updateSummary();

                    }
                );


                document
                    .getElementById('annee_scolaire_id')
                    .addEventListener(
                        'change',
                        function () {

                            updateSummary();

                        }
                    );


                function loadClasses(
                    selectedLevel,
                    selectElement,
                    onSuccess,
                    onError
                ) {

                    const url =
                        "{{ route('inscriptions.classes', ':level') }}"
                            .replace(
                                ':level',
                                encodeURIComponent(selectedLevel)
                            );

                    fetch(url, {

                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }

                    })

                    .then(function (response) {

                        if (!response.ok) {

                            throw new Error(
                                'Erro HTTP'
                            );

                        }

                        return response.json();

                    })

                    .then(function (classes) {

                        selectElement.innerHTML =
                            '<option value="">-- Selecione a classe --</option>';

                        if (
                            !classes ||
                            !classes.length
                        ) {

                            selectElement.innerHTML =
                                '<option value="">Nenhuma classe encontrada</option>';

                            if (typeof onSuccess === 'function') {
                                onSuccess();
                            }

                            return;
                        }

                        classes.forEach(function (classeItem) {

                            const option =
                                document.createElement('option');

                            option.value =
                                classeItem.id;

                            option.textContent =
                                classeItem.name ||
                                classeItem.nome ||
                                classeItem.designacao ||
                                (
                                    'Classe ' +
                                    classeItem.id
                                );

                            selectElement.appendChild(
                                option
                            );

                        });

                        if (typeof onSuccess === 'function') {

                            onSuccess();

                        }

                    })

                    .catch(function () {

                        if (typeof onError === 'function') {

                            onError();

                        }

                    });

                }


                function updateSummary() {

                    if (!eleveId.value) {

                        summarySection.style.display =
                            'none';

                        saveBtn.disabled =
                            true;

                        return;
                    }

                    const yearSelect =
                        document.getElementById(
                            'annee_scolaire_id'
                        );

                    const yearText =
                        yearSelect.selectedIndex > 0
                            ? yearSelect.options[
                                yearSelect.selectedIndex
                            ].textContent.trim()
                            : '—';

                    const classText =
                        classe.selectedIndex > 0
                            ? classe.options[
                                classe.selectedIndex
                            ].textContent.trim()
                            : '—';

                    const levelText =
                        level.value ||
                        '—';

                    document.getElementById(
                        'summaryStudent'
                    ).textContent =
                        document.getElementById(
                            'selectedStudentName'
                        ).textContent;

                    document.getElementById(
                        'summaryMatricula'
                    ).textContent =
                        document.getElementById(
                            'selectedStudentMatricula'
                        ).textContent;

                    document.getElementById(
                        'summaryYear'
                    ).textContent =
                        yearText;

                    document.getElementById(
                        'summaryLevel'
                    ).textContent =
                        levelText;

                    document.getElementById(
                        'summaryClass'
                    ).textContent =
                        classText;

                    const ready =
                        Boolean(
                            eleveId.value &&
                            yearSelect.value &&
                            level.value &&
                            classe.value
                        );

                    if (ready) {

                        summarySection.style.display =
                            'block';

                        saveBtn.disabled =
                            false;

                        updateSteps(3);

                    } else {

                        summarySection.style.display =
                            'none';

                        saveBtn.disabled =
                            true;

                        updateSteps(2);

                    }

                }


                inscriptionForm.addEventListener(
                    'submit',
                    function (event) {

                        const year =
                            document.getElementById(
                                'annee_scolaire_id'
                            ).value;

                        if (!eleveId.value) {

                            event.preventDefault();

                            showError(
                                'Selecione um aluno antes de concluir a inscrição.'
                            );

                            return;
                        }

                        if (!year) {

                            event.preventDefault();

                            showError(
                                'Selecione o ano letivo.'
                            );

                            return;
                        }

                        if (!level.value) {

                            event.preventDefault();

                            showError(
                                'Selecione o nível.'
                            );

                            return;
                        }

                        if (!classe.value) {

                            event.preventDefault();

                            showError(
                                'Selecione a classe.'
                            );

                            return;
                        }

                        saveBtn.disabled =
                            true;

                        saveBtn.innerHTML = `

                            <i class="fas fa-spinner fa-spin"></i>

                            A guardar...

                        `;

                    }
                );


                function updateSteps(currentStep) {

                    const steps = [
                        document.getElementById('step1'),
                        document.getElementById('step2'),
                        document.getElementById('step3')
                    ];

                    steps.forEach(function (step, index) {

                        const number =
                            index + 1;

                        step.classList.remove(
                            'active',
                            'completed'
                        );

                        if (number < currentStep) {

                            step.classList.add(
                                'completed'
                            );

                        }

                        if (number === currentStep) {

                            step.classList.add(
                                'active'
                            );

                        }

                    });

                }


                function showError(message) {

                    studentResult.style.display =
                        'block';

                    studentResult.className =
                        'student-result error';

                    studentResult.innerHTML = `

                        <i class="fas fa-exclamation-circle"></i>

                        ${escapeHtml(message)}

                    `;

                    studentResult.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });

                }


                function setButtonLoading(
                    button,
                    text
                ) {

                    button.disabled =
                        true;

                    button.innerHTML = `

                        <i class="fas fa-spinner fa-spin"></i>

                        ${escapeHtml(text)}

                    `;

                }


                function resetButton(
                    button,
                    html
                ) {

                    button.disabled =
                        false;

                    button.innerHTML =
                        html;

                }


                function escapeHtml(value) {

                    const div =
                        document.createElement('div');

                    div.textContent =
                        value ?? '';

                    return div.innerHTML;

                }

            }
        );

    </script>

</body>

</html>