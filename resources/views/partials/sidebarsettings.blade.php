@php
    $userFunction = strtolower(auth()->user()->function);
    $isAdminOrDirection = in_array($userFunction, ['admin', 'direction', 'parent']);
@endphp

<!-- Overlay pour fermer le menu en cliquant à l'extérieur -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <!-- Accueil -->
    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span>Accueil
    </a>
    <hr>

    <!-- Élèves -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-graduate"></i></span> Élèves
    </a>
    <div class="submenu">
        <a href="{{ route('eleve.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        <a href="#"><i class="fas fa-user-plus"></i> Créer</a>
        <a href="{{ route('eleve.listeleve') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Parents -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-friends"></i></span> Parents
    </a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Rechercher</a>
        <a href="#"><i class="fas fa-user-plus"></i> Créer</a>
        <a href="#"><i class="fas fa-address-book"></i> Lister</a>
        @if($isAdminOrDirection)
           <a href="{{ route('professors.listprofessors') }}"><i class="fas fa-comments"></i> EDRP</a>
        @endif
    </div>
    <hr>

        <!-- Utilisateur -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">👤</span> Utilisateur
    </a>
    <div class="submenu">
        <a href="{{ route('users.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        <a href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> Créer</a>
        <a href="{{ route('users.listusers') }}"><i class="fas fa-users"></i> Lister</a>
        <a href="{{ route('users.droits') }}"><i class="fas fa-key"></i> Droits</a>
    </div>
    <hr>
    <!-- Statistiques -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">📊</span> Statistiques
    </a>
    <div class="submenu">
      <a href="{{ route('estatistics.salasporedificio') }}"><i class="fas fa-search"></i> Salle / Bâtiment</a>
      <a href="{{ route('estatistics.professorpormatiere')}}"><i class="fas fa-user-graduate"></i> Professeur / Matière</a>
      <a href="{{ route('estatistics.eventosporsala') }}"><i class="fas fa-calendar-alt"></i> Événement / Salle</a>
    </div>
    <hr>

     <!-- Eventos -->
      <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> Événements
    </a>
    <div class="submenu">
        <a href="{{ route('events.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('events.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('events.listevents') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>


    <!-- Prog-Événement -->
      <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> Prog-Événem
    </a>
    <div class="submenu">
        <a href="{{ route('progevents.search') }}"><i class="fas fa-search"></i> Rechercher</a>
        @if($isAdminOrDirection)
            <a href="{{ route('progevents.create') }}"><i class="fas fa-plus"></i> Créer</a>
        @endif
        <a href="{{ route('progevents.listprogevents') }}"><i class="fas fa-list"></i> Lister</a>
    </div>
    <hr>

    <!-- Disponibilité des Salles -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">🚪</span> Dispo-Salles
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-check-circle"></i> Disponible</a>
      <a href="#"><i class="fas fa-times-circle"></i> Indisponible</a>
    </div>
    <hr>

   <!-- Générer Emploi du Temps -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">🕒</span> Emploi du Temps
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-building"></i> Par Bâtiment</a>
      <a href="#"><i class="fas fa-door-open"></i> Par Salle</a>
      <a href="#"><i class="fas fa-chalkboard-teacher"></i> Par Professeur</a>
    </div>
    <hr>

    <!-- Gérer les Logs -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">⚙️</span> Gérer-Logs
    </a>
    <div class="submenu">
      <a href="{{ route('userlogs.admin') }}" title="Ver logs de Admin">
          <i class="fas fa-user-shield"></i> Admin
      </a>
      <a href="{{ route('userlogs.direction') }}" title="Ver logs da Direção">
          <i class="fas fa-chalkboard-teacher"></i> Direction
      </a>
      <a href="{{ route('userlogs.professeur') }}" title="Ver logs de Professores">
          <i class="fas fa-user-graduate"></i> Professeur
      </a>
      <a href="{{ route('userlogs.parent') }}" title="Ver logs dos Pais">
          <i class="fas fa-user-friends"></i> Parent
      </a>
      <a href="{{ route('userlogs.eleve') }}" title="Ver logs dos Alunos">
          <i class="fas fa-user"></i> Eleve
      </a>
    </div>
  
    <hr>

</div>
