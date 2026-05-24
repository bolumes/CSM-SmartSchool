<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>

    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
    <link rel="icon" href="{{ asset('img/books.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <!-- =========================
        STYLE MODERNO
    ========================== -->
    <style>

    .anuncios-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
        gap:20px;
        margin-top:20px;
    }

    .anuncio-card{
        background:#fff;
        border-radius:14px;
        padding:15px;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
        transition:0.3s;
        border-left:4px solid #1c359d;
    }

    .anuncio-card:hover{
        transform:translateY(-5px);
    }

    .anuncio-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-size:13px;
        color:#666;
    }

    .anuncio-title{
        margin:10px 0;
        font-size:16px;
        color:#1c359d;
    }

    .anuncio-media{
        margin-top:10px;
        text-align:center;
    }

    .anuncio-img{
        width:100%;
        border-radius:10px;
        max-height:160px;
        object-fit:cover;
    }

    .anuncio-actions a,
    .anuncio-actions button{
        margin-left:8px;
        font-size:18px;
        cursor:pointer;
        background:none;
        border:none;
        transition:0.2s;
        color:#1c359d;
    }

    .anuncio-actions a:hover,
    .anuncio-actions button:hover{
        transform:scale(1.2);
    }

    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #38a169;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        z-index: 9999;
        animation: slideIn 0.5s, fadeOut 0.5s 3.5s forwards;
    }

    @keyframes slideIn {
        from {opacity:0; transform:translateY(-20px);}
        to {opacity:1; transform:translateY(0);}
    }

    @keyframes fadeOut {
        to {opacity:0; transform:translateY(-20px);}
    }

    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebarwelcome')

<!-- MAIN -->
<div class="main-content">

<fieldset style="border-radius:8px; border:2px solid blue;">
<legend style="text-align:center;">
    <h3 style="color:blue;">LISTA DE ANÚNCIOS</h3>
</legend>

<div class="container">

    @if(session('success'))
        <div class="toast">
            {{ session('success') }}
        </div>
    @endif

    @php
        $userFunction = Auth::user()->function;
        $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
    @endphp

    <!-- GRID MODERNO -->
    <div class="anuncios-grid">

        @forelse ($anuncios as $anuncio)

        <div class="anuncio-card">

            <!-- HEADER -->
            <div class="anuncio-header">

                <div>📅 {{ $anuncio->date }}</div>

                <div class="anuncio-actions">

                    <a href="{{ route('anuncios.show', $anuncio->id) }}" title="Ver">
                        👁️
                    </a>

                    @if ($isAdminOrDirection)
                        <a href="{{ route('anuncios.edit', $anuncio->id) }}" title="Editar">
                            ✏️
                        </a>

                        <button onclick="confirmDelete({{ $anuncio->id }})" title="Eliminar">
                            🗑️
                        </button>
                    @endif

                </div>

            </div>

            <!-- TÍTULO -->
            <h3 class="anuncio-title">
                {{ $anuncio->titre }}
            </h3>

            <!-- FICHEIRO -->
            <div class="anuncio-media">

                @php
                    $filePath = asset('storage/' . $anuncio->fichier);
                    $extension = pathinfo($anuncio->fichier, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($extension), ['jpg','jpeg','png']))

                    <a href="{{ $filePath }}" data-lightbox="img-{{ $anuncio->id }}">
                        <img src="{{ $filePath }}" class="anuncio-img">
                    </a>

                @elseif(strtolower($extension) === 'pdf')

                    <a href="{{ $filePath }}" target="_blank">
                        📄 Abrir PDF
                    </a>

                @else
                    <span>Sem ficheiro</span>
                @endif

            </div>

        </div>

        @empty
            <p style="text-align:center;">Nenhum anúncio encontrado.</p>
        @endforelse

    </div>

</div>
</fieldset>
</div>

<!-- =========================
    SCRIPTS
========================= -->
<script>

/* =========================
   MENU SIDEBAR
========================= */
function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (sidebar) {
        sidebar.classList.toggle("open");
    }

    if (overlay) {
        overlay.classList.toggle("active");
    }
}


/* =========================
   FECHAR AO CLICAR FORA
========================= */
document.addEventListener("click", function (event) {

    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".menu-toggle");
    const overlay = document.getElementById("overlay");

    if (!sidebar || !toggleBtn) return;

    const clickedInsideSidebar = sidebar.contains(event.target);
    const clickedToggle = toggleBtn.contains(event.target);

    if (!clickedInsideSidebar && !clickedToggle) {

        sidebar.classList.remove("open");

        if (overlay) {
            overlay.classList.remove("active");
        }
    }
});


/* =========================
   SUBMENU (caso exista no sidebar)
========================= */
function toggleSubmenu(element) {

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
   DELETE CONFIRM
========================= */
function confirmDelete(id) {

    Swal.fire({
        title: 'Tem certeza?',
        text: "Essa ação não pode ser desfeita.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if (result.isConfirmed) {

            const form = document.getElementById('delete-form-' + id);

            if (form) {
                form.submit();
            }
        }
    });
}

</script>
</body>
</html>