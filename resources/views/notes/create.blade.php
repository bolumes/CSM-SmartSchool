<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nota</title>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="icon" href="{{ asset('img/books.png') }}">

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
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>
    <div class="search">
        <input type="text" placeholder="Pesquisar...">
    </div>
</div>

@include('partials.sidebargestacad')

<!-- CONTEÚDO -->
<div class="main-content">
<fieldset style="border-radius: 8px; border: 2px solid blue">

<legend style="text-align: center;">
    <h3 style="color: blue;">CREER NOTE</h3>
</legend>

<div class="container">

    <!-- IMAGEM -->
    <div class="form-image">
        <img src="{{ asset('img/ajouter.png') }}" style="height:50px; margin-left:40px;">
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

        <form action="{{ route('notes.store') }}" method="POST">
            @csrf

            <!-- NIVEAU -->
            <div class="col-md-6">
                <label>Niveau</label>
                <select name="niveau" id="niveau" class="form-control" required>
                    <option value="">Escolher...</option>
                    <option value="Maternelle">Maternelle</option>
                    <option value="Elementaire">Elementaire</option>
                    <option value="College">College</option>
                    <option value="Lycee">Lycee</option>
                </select>
            </div>

            <!-- CLASSE -->
            <div class="col-md-6">
                <label>Classe</label>
                <select name="classe_id" id="classe_id" class="form-control" required>
                    <option value="">Escolher...</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">
                            {{ $classe->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- ALUNO -->
            <div class="col-md-6">
                <label>Aluno</label>
                <select name="eleve_id" id="eleve_id" class="form-control" disabled required>
                    <option value="">Escolher a classe primeiro...</option>
                </select>
            </div>

            <!-- MATÉRIA -->
            <div class="col-md-6">
                <label>Matéria</label>
                <select name="matiere_id" id="matiere_id" class="form-control" required>
                    <option value="">Escolher nível primeiro...</option>
                </select>
            </div>

            <!-- PROFESSOR -->
            <div class="col-md-6">
                <label>Professor</label>
                <select name="professor_id" class="form-control" required>
                    <option value="">Escolher...</option>
                    @foreach($professors as $prof)
                        <option value="{{ $prof->id }}">
                            {{ $prof->firstname }} {{ $prof->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- NOTA -->
            <div class="col-md-6">
                <label>Nota</label>
                <input type="number" step="0.01" name="nota" class="form-control" value="{{ old('nota') }}" required>
            </div>

            <!-- TRIMESTRE -->
            <div class="col-md-6">
                <label>Trimestre</label>
                <select name="trimestre" class="form-control" required>
                    <option value="">Escolher...</option>
                    <option value="1">1º</option>
                    <option value="2">2º</option>
                    <option value="3">3º</option>
                </select>
            </div>

            <!-- ANO LETIVO -->
            <div class="col-md-6">
                <label>Ano Letivo</label>
                <input type="text" name="ano_letivo" class="form-control" placeholder="2025/2026" required>
            </div>

            <!-- OBSERVAÇÃO -->
            <div class="col-md-12">
                <label>Observação</label>
                <textarea name="observacao" class="form-control" rows="4"></textarea>
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
function toggleMenu() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    sidebar.classList.toggle("open");
    overlay.classList.toggle("active");
}

function toggleSubmenu(element) {
    element.classList.toggle("open");

    const submenu = element.nextElementSibling;

    submenu.style.display =
        submenu.style.display === "flex"
            ? "none"
            : "flex";
}


/* =========================
   FILTRO ALUNOS POR CLASSE
========================= */
document.getElementById('classe_id').addEventListener('change', function () {

    let classeId = this.value;
    let eleveSelect = document.getElementById('eleve_id');

    eleveSelect.innerHTML = '<option>Carregando...</option>';
    eleveSelect.disabled = true;

    if (classeId) {

        fetch('/eleves-by-classe/' + classeId)
        .then(res => res.json())
        .then(data => {

            eleveSelect.innerHTML = '<option value="">Escolher...</option>';

            if (data.length === 0) {
                eleveSelect.innerHTML = '<option>Sem alunos</option>';
                return;
            }

            data.forEach(eleve => {
                eleveSelect.innerHTML += `
                    <option value="${eleve.id}">
                        ${eleve.nome} ${eleve.apelido}
                    </option>
                `;
            });

            eleveSelect.disabled = false;
        })
        .catch(() => {
            eleveSelect.innerHTML = '<option>Erro ao carregar</option>';
        });

    } else {
        eleveSelect.innerHTML = '<option>Escolher classe primeiro...</option>';
    }
});


/* =========================
   FILTRO NÍVEL → MATÉRIAS
========================= */
const niveauSelect = document.getElementById('niveau');

if (niveauSelect) {
    niveauSelect.addEventListener('change', function () {

        let niveau = this.value;
        let matiereSelect = document.getElementById('matiere_id');

        matiereSelect.innerHTML = '<option>Carregando...</option>';

        if (niveau) {

            fetch('{{ url("/matieres-by-niveau") }}/' + niveau)
            .then(res => res.json())
            .then(data => {

                matiereSelect.innerHTML = '<option value="">Escolher...</option>';

                if (data.length === 0) {
                    matiereSelect.innerHTML = '<option>Sem matérias</option>';
                    return;
                }

                data.forEach(matiere => {
                    matiereSelect.innerHTML += `
                        <option value="${matiere.id}">
                            ${matiere.name ?? matiere.code}
                        </option>
                    `;
                });
            })
            .catch(() => {
                matiereSelect.innerHTML = '<option>Erro ao carregar</option>';
            });

        } else {
            matiereSelect.innerHTML = '<option>Escolher nível primeiro...</option>';
        }
    });
}

</script>

</body>
</html>