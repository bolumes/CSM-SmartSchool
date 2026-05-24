<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM-SmartSchool</title>
    <link rel="stylesheet" href="{{ asset('css/styledroit.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/books.png') }}">
    <style>
        /* Additional styles for form elements */
        .permission-table input,
        .permission-table select,
        .permission-table textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .permission-table textarea {
            resize: vertical;
        }
        .permission-table label {
            font-weight: normal;
            display: block;
            margin: 0;
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
        .file-preview {
            margin-top: 8px;
            font-size: 13px;
        }
        .file-preview a {
            color: #1c359d;
            text-decoration: none;
        }
        .file-preview a:hover {
            text-decoration: underline;
        }
        .file-preview img {
            max-width: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 2px;
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

@include('partials.sidebarwelcome')

<div class="main-content">
    <fieldset style="border-radius:8px; border:2px solid blue">
        <legend style="text-align:center">
            <h3 style="color:blue">EDITER L'ANNONCE</h3>
        </legend>

        <div class="container">
            <div style="text-align: center;">
                <img src="{{ asset('img/modif01.png') }}" alt="Editar" style="height: 50px;">
            </div>

            @if(session('success'))
                <div class="toast">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('anuncios.update', $anuncio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <table class="permission-table">
                    <thead>
                        <tr>
                            <th>ATTRIBUT</th>
                            <th>VALEUR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>
                                <input type="date" name="date" value="{{ old('date', $anuncio->date) }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Titre</strong></td>
                            <td>
                                <input type="text" name="titre" value="{{ old('titre', $anuncio->titre) }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Description</strong></td>
                            <td>
                                <textarea name="description" rows="4" required>{{ old('description', $anuncio->description) }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Fichier</strong></td>
                            <td>
                                <input type="file" name="fichier" accept=".jpg,.jpeg,.pdf">
                                @if($anuncio->fichier)
                                    <div class="file-preview">
                                        @php
                                            $filePath = asset('storage/' . $anuncio->fichier);
                                            $ext = strtolower(pathinfo($anuncio->fichier, PATHINFO_EXTENSION));
                                        @endphp
                                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                            <a href="{{ $filePath }}" target="_blank">
                                                <img src="{{ $filePath }}" alt="Imagem atual">
                                            </a>
                                        @elseif($ext === 'pdf')
                                            <a href="{{ $filePath }}" target="_blank">📄 Visualizar PDF atual</a>
                                        @endif
                                        <br><small>Deixe em branco para manter o ficheiro atual.</small>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="btn-group-center">
                                    <button type="reset" class="action-btn btn-cancel">Annuler</button>
                                    <button type="submit" class="action-btn btn-submit">Actualiser</button>
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

    function toggleSubmenu(element, event) {
        if (event) event.preventDefault();
        element.classList.toggle("open");
        const submenu = element.nextElementSibling;
        if (submenu) {
            submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
            if (submenu.style.display === "flex") submenu.style.flexDirection = "column";
        }
    }
</script>

</body>
</html>