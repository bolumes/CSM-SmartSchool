@php
    $userFunction = auth()->user()->function;
    $isAdminOrDirection = $userFunction === 'Admin' || $userFunction === 'Direction';
@endphp

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <a href="{{ route('home.welcome') }}"><span class="icon">🏠</span> Accueil</a>
    <hr>

    <!-- Edifícios -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏢</span> Edifices</a>
    <div class="submenu">
        <a href="{{ route('edificios.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('edificios.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('edificios.listedificios') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Salas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏫</span> Salles</a>
    <div class="submenu">
        <a href="{{ route('salas.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('salas.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('salas.listsalas') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Classes -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> Classes </a>
    <div class="submenu">
        <a href="{{ route('classes.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('classes.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('classes.listclasses') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Matiere -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> Matiere </a>
    <div class="submenu">
        <a href="{{ route('matieres.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('matieres.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('matieres.listmatieres') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Professores -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">👨‍🏫</span> Professeurs</a>
    <div class="submenu">
        <a href="{{ route('professors.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('professors.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('professors.listprofessors') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Configurações -->
    <a href="{{ route('home.settings') }}"><span class="icon">⚙️</span> Paramètres</a>
    <hr>

    <!-- Logout -->
    <a href="{{ route('home.sair') }}" class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-power-off"></i></span> Logout
    </a>
    <hr>
</div>
