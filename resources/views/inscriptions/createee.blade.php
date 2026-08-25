<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSM-SmartSchool - Nova Inscrição</title>

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
           CONTAINER PRINCIPAL
        ===================================================== */

        .inscription-container {
            display: flex;
            gap: 35px;
            align-items: flex-start;
            padding: 25px;
        }

        .form-image {
            width: 20%;
            display: flex;
            justify-content: center;
            padding-top: 35px;
        }

        .form-image img {
            width: 160px;
            max-width: 100%;
        }

        .form-container {
            width: 80%;
        }


        /* =====================================================
           SECÇÕES
        ===================================================== */

        .form-section {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fafafa;
        }

        .form-section-title {
            color: blue;
            font-size: 17px;
            font-weight: 600;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }


        /* =====================================================
           LINHAS
        ===================================================== */

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 16px;
        }

        .form-group {
            flex: 1;
        }

        .form-group-full {
            width: 100%;
            margin-bottom: 16px;
        }


        /* =====================================================
           LABELS / INPUTS
        ===================================================== */

        .form-label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #333;
        }

        .required {
            color: red;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: blue;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 0, 255, .15);
        }

        .form-control:disabled {
            background-color: #eee;
            cursor: not-allowed;
        }

        .form-help {
            display: block;
            margin-top: 5px;
            color: #777;
            font-size: 12px;
        }


        /* =====================================================
           TIPO DE ALUNO
        ===================================================== */

        .student-type {
            display: flex;
            gap: 15px;
        }

        .student-type-option {
            flex: 1;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background: white;
            cursor: pointer;
        }

        .student-type-option:hover {
            border-color: blue;
        }

        .student-type-option input {
            margin-right: 8px;
        }

        .student-type-option strong {
            color: #333;
        }

        .student-type-option small {
            display: block;
            margin-top: 5px;
            margin-left: 24px;
            color: #777;
        }


        /* =====================================================
           ALUNO FILTRADO
        ===================================================== */

        #studentSection {
            display: none;
        }

        .student-info {
            background: #eef7ff;
            border: 1px solid #90caf9;
            border-radius: 7px;
            padding: 12px 15px;
            margin-top: 10px;
            color: #444;
        }


        /* =====================================================
           BOTÕES
        ===================================================== */

        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-save {
            border: none;
            cursor: pointer;
            padding: 11px 25px;
            border-radius: 6px;
            background-color: blue;
            color: white;
            font-size: 15px;
        }

        .btn-save:hover {
            opacity: .9;
        }

        .btn-cancel {
            padding: 11px 25px;
            border-radius: 6px;
            background-color: #777;
            color: white;
            text-decoration: none;
            font-size: 15px;
        }

        .btn-cancel:hover {
            background-color: #555;
        }


        /* =====================================================
           ERROS
        ===================================================== */

        .error-box {
            background: #ffe6e6;
            border: 1px solid #ff6666;
            color: #b30000;
            padding: 12px 18px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin-bottom: 0;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #38a169;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,.2);
            z-index: 9999;
            animation:
                slideIn .5s,
                fadeOut .5s 3.5s forwards;
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


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media(max-width: 768px) {

            .inscription-container {
                flex-direction: column;
            }

            .form-image,
            .form-container {
                width: 100%;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .student-type {
                flex-direction: column;
            }

            .button-container {
                flex-direction: column;
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
            type="hidden"
            placeholder="Pesquisar..."
        >

    </div>

</div>


<!-- =========================================================
     SIDEBAR
========================================================= -->

@include('partials.sidebargestacad')


<!-- =========================================================
     CONTEÚDO PRINCIPAL
========================================================= -->

<div class="main-content">

    <fieldset
        style="
            border-radius:8px;
            border:2px solid blue;
        "
    >

        <legend style="text-align:center">

            <h3
                style="
                    color:blue;
                    text-align:center;
                "
            >

                <i class="fas fa-user-plus"></i>

                Nova Inscrição

            </h3>

        </legend>


        <div class="inscription-container">


            <!-- =================================================
                 IMAGEM
            ================================================== -->

            <div class="form-image">

                <img
                    src="{{ asset('img/inscription.png') }}"
                    alt="Nova inscrição"
                    onerror="this.style.display='none'"
                >

            </div>


            <!-- =================================================
                 FORMULÁRIO
            ================================================== -->

            <div class="form-container">


                <!-- =================================================
                     MENSAGEM DE SUCESSO
                ================================================== -->

                @if(session('success'))

                    <div class="toast">

                        <i class="fas fa-check-circle"></i>

                        {{ session('success') }}

                    </div>

                @endif


                <!-- =================================================
                     ERROS
                ================================================== -->

                @if($errors->any())

                    <div class="error-box">

                        <strong>

                            <i class="fas fa-exclamation-triangle"></i>

                            Verifique os seguintes erros:

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


                <form
                    action="{{ route('inscriptions.store') }}"
                    method="POST"
                    id="inscriptionForm"
                >

                    @csrf


                    <!-- =================================================
                         1. TIPO / DATA
                    ================================================== -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="fas fa-file-signature"></i>

                            Dados da inscrição

                        </div>


                        <div class="form-row">


                            <!-- TIPO -->

                            <div class="form-group">

                                <label class="form-label">

                                    Tipo de aluno

                                    <span class="required">*</span>

                                </label>


                                <div class="student-type">


                                    <label class="student-type-option">

                                        <input
                                            type="radio"
                                            name="student_type"
                                            value="existing"
                                            {{ old('student_type', 'existing') == 'existing' ? 'checked' : '' }}
                                        >

                                        <strong>
                                            Aluno existente
                                        </strong>

                                        <small>
                                            O aluno já está registado.
                                        </small>

                                    </label>


                                    <label class="student-type-option">

                                        <input
                                            type="radio"
                                            name="student_type"
                                            value="new"
                                            {{ old('student_type') == 'new' ? 'checked' : '' }}
                                        >

                                        <strong>
                                            Novo aluno
                                        </strong>

                                        <small>
                                            Criar um novo aluno.
                                        </small>

                                    </label>

                                </div>

                            </div>


                            <!-- DATA -->

                            <div
                                class="form-group"
                                style="max-width:220px;"
                            >

                                <label
                                    for="data_inscricao"
                                    class="form-label"
                                >

                                    Data da inscrição

                                    <span class="required">*</span>

                                </label>


                                <input
                                    type="date"
                                    name="data_inscricao"
                                    id="data_inscricao"
                                    class="form-control"
                                    value="{{ old('data_inscricao', now()->format('Y-m-d')) }}"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         2. DADOS DO ALUNO
                    ================================================== -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="fas fa-user-graduate"></i>

                            Dados do aluno

                        </div>


                        <!-- NOME / APELIDO -->

                        <div class="form-row">

                            <div class="form-group">

                                <label
                                    for="firstname"
                                    class="form-label"
                                >

                                    Nome

                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="firstname"
                                    id="firstname"
                                    class="form-control"
                                    value="{{ old('firstname') }}"
                                    placeholder="Nome"
                                >

                            </div>


                            <div class="form-group">

                                <label
                                    for="lastname"
                                    class="form-label"
                                >

                                    Apelido

                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="lastname"
                                    id="lastname"
                                    class="form-control"
                                    value="{{ old('lastname') }}"
                                    placeholder="Apelido"
                                >

                            </div>

                        </div>


                        <!-- SEXO / DATA NASCIMENTO -->

                        <div class="form-row">

                            <div class="form-group">

                                <label
                                    for="sexo"
                                    class="form-label"
                                >

                                    Sexo

                                    <span class="required">*</span>

                                </label>

                                <select
                                    name="sexo"
                                    id="sexo"
                                    class="form-control"
                                >

                                    <option value="">
                                        -- Selecione --
                                    </option>

                                    <option
                                        value="M"
                                        {{ old('sexo') == 'M' ? 'selected' : '' }}
                                    >
                                        Masculino
                                    </option>

                                    <option
                                        value="F"
                                        {{ old('sexo') == 'F' ? 'selected' : '' }}
                                    >
                                        Feminino
                                    </option>

                                </select>

                            </div>


                            <div class="form-group">

                                <label
                                    for="data_nascimento"
                                    class="form-label"
                                >

                                    Data de nascimento

                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="date"
                                    name="data_nascimento"
                                    id="data_nascimento"
                                    class="form-control"
                                    value="{{ old('data_nascimento') }}"
                                >

                            </div>

                        </div>


                        <!-- ENDEREÇO / TELEFONE -->

                        <div class="form-row">

                            <div class="form-group">

                                <label
                                    for="address"
                                    class="form-label"
                                >

                                    Endereço

                                </label>

                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    class="form-control"
                                    value="{{ old('address') }}"
                                    placeholder="Endereço"
                                >

                            </div>


                            <div class="form-group">

                                <label
                                    for="telephone"
                                    class="form-label"
                                >

                                    Telefone

                                </label>

                                <input
                                    type="text"
                                    name="telephone"
                                    id="telephone"
                                    class="form-control"
                                    value="{{ old('telephone') }}"
                                    placeholder="Telefone"
                                >

                            </div>

                        </div>


                        <!-- ENCARREGADO -->

                        <div class="form-group-full">

                            <label
                                for="parent_id"
                                class="form-label"
                            >

                                <i class="fas fa-user-friends"></i>

                                Encarregado de educação

                                <span class="required">*</span>

                            </label>


                            <select
                                name="parent_id"
                                id="parent_id"
                                class="form-control"
                            >

                                <option value="">
                                    -- Selecione o encarregado --
                                </option>


                                @foreach($parents as $parent)

                                    <option
                                        value="{{ $parent->id }}"
                                        {{ old('parent_id') == $parent->id ? 'selected' : '' }}
                                    >

                                        {{ $parent->firstname }}

                                        {{ $parent->lastname }}

                                        @if($parent->telephone)

                                            — {{ $parent->telephone }}

                                        @endif

                                    </option>

                                @endforeach

                            </select>


                            <small class="form-help">

                                O encarregado deve estar registado como
                                <strong>parent</strong> no sistema.

                            </small>

                        </div>

                    </div>


                    <!-- =================================================
                         3. NÍVEL / CLASSE
                    ================================================== -->

                    <div class="form-section">

                        <div class="form-section-title">

                            <i class="fas fa-school"></i>

                            Nível e Classe

                        </div>


                        <div class="form-row">


                            <!-- NÍVEL -->

                            <div class="form-group">

                                <label
                                    for="level"
                                    class="form-label"
                                >

                                    Nível

                                    <span class="required">*</span>

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

                                <small class="form-help">

                                    O nível determina as classes disponíveis.

                                </small>

                            </div>


                            <!-- CLASSE -->

                            <div class="form-group">

                                <label
                                    for="classe_id"
                                    class="form-label"
                                >

                                    Classe

                                    <span class="required">*</span>

                                </label>


                                <select
                                    name="classe_id"
                                    id="classe_id"
                                    class="form-control"
                                    required
                                    disabled
                                >

                                    <option value="">
                                        -- Primeiro selecione o nível --
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         4. ALUNO
                         APARECE DEPOIS DE NÍVEL + CLASSE
                    ================================================== -->

                    <div id="studentSection" class="form-section" >

                        <div class="form-section-title">

                            <i class="fas fa-user-graduate"></i>

                            Aluno

                        </div>


                        <div class="form-group-full">

                            <label
                                for="eleve_id"
                                class="form-label"
                            >

                                Selecionar aluno

                                <span class="required">*</span>

                            </label>


                            <select
                                name="eleve_id"
                                id="eleve_id"
                                class="form-control"
                                disabled
                            >

                                <option value="">
                                    -- Primeiro selecione a classe --
                                </option>

                            </select>


                            <small class="form-help">

                                Serão apresentados apenas os alunos
                                pertencentes à classe selecionada.

                            </small>

                        </div>


                        <div
                            id="studentInfo"
                            class="student-info"
                            style="display:none;"
                        >

                            <i class="fas fa-info-circle"></i>

                            <span id="studentInfoText"></span>

                        </div>

                    </div>


                    <!-- =================================================
                         BOTÕES
                    ================================================== -->

                    <div class="button-container">

                        <button
                            type="submit"
                            class="btn-save"
                        >

                            <i class="fas fa-save"></i>

                            Guardar inscrição

                        </button>


                        <a
                            href="{{ route('inscriptions.index') }}"
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

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       ELEMENTOS
    ========================================================= */

    const levelSelect =
        document.getElementById('level');

    const classeSelect =
        document.getElementById('classe_id');

    const studentSection =
        document.getElementById('studentSection');

    const eleveSelect =
        document.getElementById('eleve_id');

    const studentInfo =
        document.getElementById('studentInfo');

    const studentInfoText =
        document.getElementById('studentInfoText');

    const typeRadios =
        document.querySelectorAll(
            'input[name="student_type"]'
        );


    /* =========================================================
       TIPO DE ALUNO
    ========================================================= */

    function getStudentType()
    {
        const selected =
            document.querySelector(
                'input[name="student_type"]:checked'
            );

        return selected
            ? selected.value
            : 'existing';
    }


    /* =========================================================
       CAMPOS DO NOVO ALUNO
    ========================================================= */

    const newStudentFields = [
        'firstname',
        'lastname',
        'sexo',
        'data_nascimento',
        'address',
        'telephone',
        'parent_id'
    ];


    function updateStudentType()
    {

        const type =
            getStudentType();


        /*
        |--------------------------------------------------------------------------
        | NOVO ALUNO
        |--------------------------------------------------------------------------
        */

        if (type === 'new') {

            /*
            | O campo aluno não é necessário
            | porque ele será criado.
            */

            studentSection.style.display =
                'none';

            eleveSelect.required =
                false;

            eleveSelect.disabled =
                true;


            /*
            | Dados pessoais obrigatórios
            */

            document.getElementById(
                'firstname'
            ).required = true;

            document.getElementById(
                'lastname'
            ).required = true;

            document.getElementById(
                'sexo'
            ).required = true;

            document.getElementById(
                'data_nascimento'
            ).required = true;

            document.getElementById(
                'parent_id'
            ).required = true;

        }


        /*
        |--------------------------------------------------------------------------
        | ALUNO EXISTENTE
        |--------------------------------------------------------------------------
        */

        else {

            /*
            | O campo aluno será mostrado
            | depois de nível + classe.
            */

            eleveSelect.required =
                true;


            /*
            | Dados pessoais não precisam
            | ser preenchidos novamente.
            */

            document.getElementById(
                'firstname'
            ).required = false;

            document.getElementById(
                'lastname'
            ).required = false;

            document.getElementById(
                'sexo'
            ).required = false;

            document.getElementById(
                'data_nascimento'
            ).required = false;

            document.getElementById(
                'parent_id'
            ).required = false;

        }

    }


    typeRadios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            updateStudentType
        );

    });


    updateStudentType();


    /* =========================================================
       NÍVEL → CLASSE
    ========================================================= */

    levelSelect.addEventListener(
        'change',
        function ()
        {

            const level =
                this.value;


            /*
            | Limpar classe
            */

            classeSelect.innerHTML = `
                <option value="">
                    -- Selecione a classe --
                </option>
            `;


            classeSelect.disabled =
                true;


            /*
            | Esconder aluno
            */

            studentSection.style.display =
                'none';

            eleveSelect.innerHTML = `
                <option value="">
                    -- Primeiro selecione a classe --
                </option>
            `;

            eleveSelect.disabled =
                true;


            studentInfo.style.display =
                'none';


            /*
            | Se não houver nível
            */

            if (!level) {

                classeSelect.innerHTML = `
                    <option value="">
                        -- Primeiro selecione o nível --
                    </option>
                `;

                return;

            }


            /*
            | Loading
            */

            classeSelect.innerHTML = `
                <option value="">
                    Carregando classes...
                </option>
            `;


            /*
            | URL do controller
            */

            const url =
                "{{ route('inscriptions.classes', ':level') }}"
                .replace(
                    ':level',
                    encodeURIComponent(level)
                );


            fetch(url)

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Erro ao carregar classes.'
                        );

                    }

                    return response.json();

                })

                .then(function (classes) {


                    classeSelect.innerHTML = `
                        <option value="">
                            -- Selecione a classe --
                        </option>
                    `;


                    if (classes.length === 0) {

                        classeSelect.innerHTML = `
                            <option value="">
                                Nenhuma classe encontrada
                            </option>
                        `;

                        return;

                    }


                    classes.forEach(
                        function (classe)
                        {

                            const option =
                                document.createElement(
                                    'option'
                                );


                            option.value =
                                classe.id;


                            option.textContent =
                                classe.name +
                                (
                                    classe.code
                                        ? ' (' +
                                          classe.code +
                                          ')'
                                        : ''
                                );


                            classeSelect.appendChild(
                                option
                            );

                        }
                    );


                    classeSelect.disabled =
                        false;


                    /*
                    | Recuperar classe anterior
                    */

                    const oldClasse =
                        "{{ old('classe_id') }}";


                    if (oldClasse) {

                        classeSelect.value =
                            oldClasse;

                    }

                })

                .catch(function (error) {

                    console.error(error);

                    classeSelect.innerHTML = `
                        <option value="">
                            Erro ao carregar classes
                        </option>
                    `;

                });

        }
    );


    /* =========================================================
       CLASSE → ALUNOS
    ========================================================= */

    classeSelect.addEventListener(
        'change',
        function ()
        {

            const classeId =
                this.value;


            /*
            | Limpar alunos
            */

            eleveSelect.innerHTML = `
                <option value="">
                    -- Selecione o aluno --
                </option>
            `;


            eleveSelect.disabled =
                true;


            studentInfo.style.display =
                'none';


            /*
            | Novo aluno:
            | não precisamos carregar alunos.
            */

            if (
                getStudentType() === 'new'
            ) {

                studentSection.style.display =
                    'none';

                return;

            }


            /*
            | Sem classe
            */

            if (!classeId) {

                studentSection.style.display =
                    'none';

                return;

            }


            /*
            | Mostrar secção
            */

            studentSection.style.display =
                'block';


            /*
            | Loading
            */

            eleveSelect.innerHTML = `
                <option value="">
                    Carregando alunos...
                </option>
            `;


            /*
            | Buscar alunos
            */

            const url =
                "{{ route('inscriptions.students', ':classe') }}"
                .replace(
                    ':classe',
                    classeId
                );


            fetch(url)

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Erro ao carregar alunos.'
                        );

                    }

                    return response.json();

                })

                .then(function (students) {


                    eleveSelect.innerHTML = `
                        <option value="">
                            -- Selecione o aluno --
                        </option>
                    `;


                    if (students.length === 0) {

                        eleveSelect.innerHTML = `
                            <option value="">
                                Nenhum aluno disponível
                            </option>
                        `;

                        eleveSelect.disabled =
                            true;

                        return;

                    }


                    students.forEach(
                        function (student)
                        {

                            const option =
                                document.createElement(
                                    'option'
                                );


                            option.value =
                                student.id;


                            option.textContent =
                                student.name +
                                ' — Matrícula: ' +
                                student.matricula;


                            /*
                            | Guardar informações
                            */

                            option.dataset.name =
                                student.name;

                            option.dataset.matricula =
                                student.matricula;


                            eleveSelect.appendChild(
                                option
                            );

                        }
                    );


                    eleveSelect.disabled =
                        false;


                    /*
                    | Recuperar aluno
                    | depois de erro de validação
                    */

                    const oldEleve =
                        "{{ old('eleve_id') }}";


                    if (oldEleve) {

                        eleveSelect.value =
                            oldEleve;

                        eleveSelect.dispatchEvent(
                            new Event('change')
                        );

                    }

                })

                .catch(function (error) {

                    console.error(error);

                    eleveSelect.innerHTML = `
                        <option value="">
                            Erro ao carregar alunos
                        </option>
                    `;

                });

        }
    );


    /* =========================================================
       ALUNO SELECIONADO
    ========================================================= */

    eleveSelect.addEventListener(
        'change',
        function ()
        {

            const option =
                this.options[
                    this.selectedIndex
                ];


            if (
                !this.value ||
                !option
            ) {

                studentInfo.style.display =
                    'none';

                return;

            }


            const name =
                option.dataset.name;

            const matricula =
                option.dataset.matricula;


            studentInfoText.textContent =
                name +
                ' — Matrícula: ' +
                matricula;


            studentInfo.style.display =
                'block';

        }
    );


    /* =========================================================
       RESTAURAR LEVEL
       DEPOIS DE ERRO DE VALIDAÇÃO
    ========================================================= */

    const oldLevel =
        "{{ old('level') }}";


    if (oldLevel) {

        levelSelect.value =
            oldLevel;


        levelSelect.dispatchEvent(
            new Event('change')
        );

    }

});


/* =========================================================
   MENU
========================================================= */

function toggleMenu()
{

    const sidebar =
        document.getElementById(
            "sidebar"
        );

    const overlay =
        document.getElementById(
            "overlay"
        );


    if (sidebar) {

        sidebar.classList.toggle(
            "open"
        );

    }


    if (overlay) {

        overlay.classList.toggle(
            "active"
        );

    }

}


function toggleSubmenu(element)
{

    element.classList.toggle(
        "open"
    );


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