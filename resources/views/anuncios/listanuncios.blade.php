<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Anúncios</title>
    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/books.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        /* Additional table styling to match the template */
        .permission-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        .permission-table th,
        .permission-table td {
            padding: 12px 10px;
            border: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
        }
        .permission-table th {
            background-color: #1c359d;
            color: white;
            font-weight: bold;
        }
        .permission-table tr:hover {
            background-color: #afc393;
            cursor: pointer;
        }
        .permission-table tr:hover td {
            color: #1c359d;
        }
        .action-icons a,
        .action-icons button {
            display: inline-block;
            margin: 0 3px;
        }
        .action-icons img {
            width: 28px;
            height: 28px;
            transition: transform 0.2s;
        }
        .action-icons img:hover {
            transform: scale(1.1);
        }
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
        .file-preview-img {
            max-width: 80px;
            max-height: 60px;
            border-radius: 4px;
        }
        .small-popup {
            font-size: 16px;
            padding: 20px;
        }
        .zoom-container {
            position: relative;
            display: inline-block;
        }
        .zoom-container img {
            transition: transform 0.3s ease;
        }
        .zoom-container:hover img {
            transform: scale(1.5);
            cursor: pointer;
        }
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
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOut {
            to { opacity: 0; transform: translateY(-20px); display: none; }
        }
    </style>
</head>
<body>

<!-- Overlay (optional but kept for consistency) -->
<div id="overlay" class="overlay"></div>

<!-- NAVBAR -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

<!-- Sidebar -->
@include('partials.sidebarwelcome')

<!-- MAIN CONTENT -->
<div class="main-content">
    <fieldset style="border-radius:8px; border:2px solid blue;">
        <legend style="text-align:center;">
            <h3 style="color:blue;">{{ __('messages.List of announcements') }}</h3>
        </legend>

        <div class="container">
            @if(session('success'))
                <div class="toast">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-container" style="overflow-x: auto;">
                @php
                    $userFunction = Auth::user()->function;
                    $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
                @endphp

                <table class="permission-table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.Date') }}</th>
                            <th>{{ __('messages.title') }}</th>
                            <th>{{ __('messages.Doc') }}</th>
                            <th colspan="3">{{ __('messages.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anuncios as $anuncio)
                        <tr>
                            <td>{{ $anuncio->date }}</td>
                            <td>{{ $anuncio->titre }}</td>
                            <td>
                                @php
                                    $filePath = asset('storage/' . $anuncio->fichier);
                                    $extension = pathinfo($anuncio->fichier, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                    <a href="{{ $filePath }}" data-lightbox="image-{{ $anuncio->id }}" data-title="{{ $anuncio->titre }}">
                                        <img src="{{ $filePath }}" alt="Imagem" class="file-preview-img">
                                    </a>
                                @elseif(strtolower($extension) === 'pdf')
                                    <a href="{{ $filePath }}" target="_blank" title="Visualizar PDF">
                                        <img src="{{ asset('img/pdf-icon.png') }}" alt="PDF" style="width: 30px; height: 30px;">
                                    </a>
                                @else
                                    <span>—</span>
                                @endif
                            </td>

                            {{-- Ver Detalhes --}}
                            <td class="action-icons">
                                <a href="{{ route('anuncios.show', $anuncio->id) }}" title="Ver Detalhes">
                                    <img src="{{ asset('img/det.png') }}" alt="Ver">
                                </a>
                            </td>

                            {{-- Editar --}}
                            <td class="action-icons">
                                @if ($isAdminOrDirection)
                                    <a href="{{ route('anuncios.edit', $anuncio->id) }}" title="Editar">
                                        <img src="{{ asset('img/modif02.png') }}" alt="Editar">
                                    </a>
                                @else
                                    <span style="color: #ccc;">—</span>
                                @endif
                            </td>

                            {{-- Excluir --}}
                            <td class="action-icons">
                                @if ($isAdminOrDirection)
                                    <form id="delete-form-{{ $anuncio->id }}" action="{{ route('anuncios.destroy', $anuncio->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" class="btn-icon" onclick="confirmDelete({{ $anuncio->id }})" title="Excluir">
                                        <img src="{{ asset('img/del0.png') }}" alt="Excluir">
                                    </button>
                                @else
                                    <span style="color: #ccc;">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>
</div>


<script>
    // Toggle Sidebar
    function toggleMenu() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        if (sidebar) sidebar.classList.toggle("open");
        if (overlay) overlay.classList.toggle("active");
    }

    // Close sidebar when clicking outside
    document.addEventListener("click", function(event) {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.querySelector(".menu-toggle");
        if (sidebar && toggleBtn && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("open");
            const overlay = document.getElementById("overlay");
            if (overlay) overlay.classList.remove("active");
        }
    });

    // Submenu toggle (if needed)
    function toggleSubmenu(element, event) {
        if (event) event.preventDefault();
        element.classList.toggle("open");
        const submenu = element.nextElementSibling;
        if (submenu) {
            submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
            if (submenu.style.display === "flex") submenu.style.flexDirection = "column";
        }
    }

    // SweetAlert confirmation for delete
    function confirmDelete(anuncioId) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Essa ação não pode ser desfeita.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'small-popup'
            },
            width: '400px'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form-' + anuncioId);
                if (form) form.submit();
            }
        });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>