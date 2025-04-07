<!-- Overlay transparente para fechar o menu clicando fora -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <a href="#"><span class="icon">🏠</span> Início</a>
    <hr>

    <!-- Edifícios -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏢</span> Edifícios</a>
    <div class="submenu">
        <a href="{{ route('edificios.search') }}"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="{{ route('edificios.create') }}"><i class="fas fa-plus"></i> Criar</a>
        <a href="{{ route('edificios.listedificios') }}"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    <!-- Salas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏫</span> Salas</a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    <!-- Disciplinas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> Disciplinas</a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    <!-- Formação -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🎓</span> Formação</a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    <!-- Professores -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">👨‍🏫</span> Professores</a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    
    <!-- Eventos -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> Eventos
    </a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    <!-- Eventos -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> Prog-Eventos
    </a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>


    <!-- Configurações -->
    <a href="{{ route('home.settings') }}" s><span class="icon">⚙️</span> Configurações</a>
    <hr>

    <!-- Contato -->
    <a href="#"><span class="icon">✉️</span> Contato</a>
</div>
