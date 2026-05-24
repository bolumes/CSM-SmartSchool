<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../../img/books.png">

    <!-- TOAST CSS -->
    <style>
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #38a169;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        font-weight: bold;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        z-index: 9999;

        opacity: 0;
        transform: translateY(-20px);
        animation: slideIn 0.5s forwards, fadeOut 0.5s 5s forwards;
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
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo"><img src="../../img/logo.png"></div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebargestacad')

<!-- CONTEÚDO -->
<div class="main-content">
<fieldset style="border-radius: 8px; border: 2px solid blue">

<legend style="text-align: center;">
    <h3 style="color: blue;">CREER ELEVE</h3>
</legend>

<div class="container">

    <!-- IMAGEM -->
    <div class="form-image">
        <img src="../../img/ajouter.png" style="height:50px; margin-left:40px;">
    </div>

    <!-- FORM -->
    <div class="form-container">

        <!-- TOAST SUCESSO -->
        @if(session('success'))
            <div id="toast-success" class="toast">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- ERROS -->
        @if ($errors->any())
            <div style="color:red; margin-bottom:10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('eleves.store') }}" method="POST">
            @csrf

            <!-- CLASSE -->
            <div class="col-md-6">
                <label>Classe</label>
                <select name="classe_id" class="form-control" required>
                    <option value="">Escolher...</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">
                            {{ $classe->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- MATRICULA -->
            <div class="col-md-6">
                <label>Matricula</label>
                <input type="text" name="matricula" class="form-control" required>
            </div>

            <!-- NOME -->
            <div class="col-md-6">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <!-- APELIDO -->
            <div class="col-md-6">
                <label>Apelido</label>
                <input type="text" name="apelido" class="form-control" required>
            </div>

            <!-- DATA -->
            <div class="col-md-6">
                <label>Data Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" required>
            </div>

            <!-- ENDERECO -->
            <div class="col-md-6">
                <label>Endereco</label>
                <input type="text" name="endereco" class="form-control">
            </div>

            <!-- TELEFONE -->
            <div class="col-md-6">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>

            <button type="submit" class="mt-3">Enregistrer</button>
        </form>
    </div>

</div>
</fieldset>
</div>

<script>

/* =========================
   MENU SIDEBAR
========================= */
function toggleMenu(){

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    /* ABRIR / FECHAR MENU */
    sidebar.classList.toggle("open");

    /* OVERLAY */
    if (overlay) {
        overlay.classList.toggle("active");
    }
}


/* =========================
   SUBMENU
========================= */
function toggleSubmenu(element){

    element.classList.toggle("open");

    const submenu = element.nextElementSibling;

    if (submenu) {

        submenu.style.display =
        submenu.style.display === "flex"
        ? "none"
        : "flex";
    }
}


/* =========================
   FECHAR MENU AO CLICAR FORA
========================= */
const overlay = document.getElementById("overlay");

if (overlay) {

    overlay.addEventListener("click", function(){

        document
        .getElementById("sidebar")
        .classList.remove("open");

        overlay.classList.remove("active");
    });
}


/* =========================
   REMOVE TOAST AUTOMATICAMENTE
========================= */
setTimeout(() => {

    const toast =
    document.getElementById('toast-success');

    if (toast) {
        toast.remove();
    }

}, 5500);

</script>

</body>
</html>