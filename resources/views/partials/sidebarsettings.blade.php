@php
$user = auth()->user();
$isAdminOrDirection = false;
$isAdminOrDirectionOnly = false;
$canChatParent = false;

if ($user) {
    $isAdminOrDirection = in_array($user->function, ['Admin', 'Direction', 'Parent']);
    $isAdminOrDirectionOnly = in_array($user->function, ['Admin', 'Direction']);
    $canChatParent = $user->chat_parent == 1;
}
@endphp

<!-- Overlay pour fermer le menu en cliquant à l'extérieur -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <!-- Accueil -->
    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span> {{ __('messages.Home') }}
    </a>
    <hr>

    <!-- Élèves -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-graduate"></i></span> {{ __('messages.Student') }}
    </a>
    <div class="submenu">
        <a href="{{ route('eleve.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        <a href="{{ route('eleves.listeleves') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>

    <!-- Parents -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-friends"></i></span> {{ __('messages.Parent') }}
    </a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        <a href="{{ route('parent.listparent') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
        {{-- Chat Parents --}}
        @if($canChatParent)
            <a href="{{ route('spaces.parent') }}"><i class="fas fa-comments"></i> {{ __('messages.Chat') }}</a>
        @endif
    </div>
    <hr>

        <!-- Utilisateur -->
    @if($isAdminOrDirectionOnly)
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">👤</span> {{ __('messages.User') }}
    </a>
   <div class="submenu">
            <a href="{{ route('users.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
            <a href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> {{ __('messages.Create') }}</a>
            <a href="{{ route('users.listusers') }}"><i class="fas fa-users"></i> {{ __('messages.List') }}</a>
            <a href="{{ route('users.droits') }}"><i class="fas fa-key"></i> {{ __('messages.Rights') }}</a>
    </div>
    <hr>
    @endif

    <!-- Statistiques -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">📊</span> {{ __('messages.statistics') }}
    </a>
    <div class="submenu">
      <a href="{{ route('estatistics.salasporedificio') }}"><i class="fas fa-search"></i> Salle / Bâtiment</a>
      <a href="{{ route('estatistics.professorpormatiere')}}"><i class="fas fa-user-graduate"></i> Professeur / Matière</a>
      <a href="{{ route('estatistics.eventosporsala') }}"><i class="fas fa-calendar-alt"></i> Événement / Salle</a>
    </div>
    <hr>

     <!-- Eventos -->
      <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> {{ __('messages.Events') }}
    </a>
    <div class="submenu">
        <a href="{{ route('events.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        @if($isAdminOrDirection)
            <a href="{{ route('events.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif
        <a href="{{ route('events.listevents') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>


    <!-- Prog-Événement -->
      <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> {{ __('messages.EventsPlanning') }}
    </a>
    <div class="submenu">
        <a href="{{ route('progevents.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        @if($isAdminOrDirection)
            <a href="{{ route('progevents.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif
        <a href="{{ route('progevents.listprogevents') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>

    <!-- Disponibilité des Salles -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">🚪</span> {{ __('messages.RoomAvailability') }}
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-check-circle"></i> {{ __('messages.RoomAvailability') }}</a>
      <a href="#"><i class="fas fa-times-circle"></i> {{ __('messages.RoomInavailability') }}</a>
    </div>
    <hr>

   <!-- Générer Emploi du Temps -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">🕒</span> {{ __('messages.Schedule') }}
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-building"></i> Par Bâtiment</a>
      <a href="#"><i class="fas fa-door-open"></i> Par Salle</a>
      <a href="#"><i class="fas fa-chalkboard-teacher"></i> Par Professeur</a>
    </div>
    <hr>

    <!-- Gérer les Logs -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">⚙️</span> {{ __('messages.Logs') }}
    </a>
    <div class="submenu">
      <a href="{{ route('userlogs.admin') }}" title="Ver logs de Admin">
          <i class="fas fa-user-shield"></i> Admin
      </a>
      <a href="{{ route('userlogs.direction') }}" title="Ver logs da Direção">
          <i class="fas fa-chalkboard-teacher"></i> {{ __('messages.Direction') }}
      </a>
      <a href="{{ route('userlogs.professeur') }}" title="Ver logs de Professores">
          <i class="fas fa-user-graduate"></i> {{ __('messages.Professor') }}
      </a>
      <a href="{{ route('userlogs.parent') }}" title="Ver logs dos Pais">
          <i class="fas fa-user-friends"></i> {{ __('messages.Parent') }}
      </a>
      <a href="{{ route('userlogs.eleve') }}" title="Ver logs dos Alunos">
          <i class="fas fa-user"></i> {{ __('messages.Student') }}
      </a>
    </div>
  
    <hr>

</div>
