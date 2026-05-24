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
        /* Additional styles for form elements to match the template */
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
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">
        ☰
    </div>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebarsettings')

<div class="main-content">
    <fieldset style="border-radius:8px; border:2px solid blue">
        <legend style="text-align:center">
            <h3 style="color:blue">EDITER USER</h3>
        </legend>

        <div class="container">
            <div style="text-align: center;">
                <img src="{{ asset('img/modif01.png') }}" alt="Edit Image" style="height: 50px;">
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

            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
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
                            <td><strong>Nom</strong></td>
                            <td>
                                <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Prénom</strong></td>
                            <td>
                                <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Téléphone</strong></td>
                            <td>
                                <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Adresse</strong></td>
                            <td>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Fonction</strong></td>
                            <td>
                                <select name="function">
                                    <option value="">Choisir...</option>
                                    <option value="Admin" {{ old('function', $user->function) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Direction" {{ old('function', $user->function) == 'Direction' ? 'selected' : '' }}>Direction</option>
                                    <option value="Professeur" {{ old('function', $user->function) == 'Professeur' ? 'selected' : '' }}>Professeur</option>
                                    <option value="Parent" {{ old('function', $user->function) == 'Parent' ? 'selected' : '' }}>Parent</option>
                                    <option value="Eleve" {{ old('function', $user->function) == 'Eleve' ? 'selected' : '' }}>Eleve</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Mot de Passe</strong></td>
                            <td>
                                <input type="password" name="password" placeholder="Laisser vide pour ne pas changer">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Description</strong></td>
                            <td>
                                <textarea name="description" rows="5">{{ old('description', $user->description) }}</textarea>
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
    /* Sidebar Toggle */
    function toggleMenu() {
        document.getElementById("sidebar").classList.toggle("open");
    }

    /* Click outside sidebar = close */
    document.addEventListener("click", function(event) {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.querySelector(".menu-toggle");
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("open");
        }
    });

    /* Submenu toggle */
    function toggleSubmenu(element) {
        event.preventDefault();
        const submenu = element.nextElementSibling;
        if (submenu) {
            submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
        }
    }
</script>

</body>
</html>