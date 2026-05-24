@php
$user = auth()->user();

$isAdminOrDirection = false;
$isAdminOrDirectionOnly = false;
$canChatParent = false;
$canChatProfessor = false; // 👈 FALTAVA ISTO

if ($user) {
    $isAdminOrDirection = in_array($user->function, ['Admin', 'Direction', 'Parent']);
    $isAdminOrDirectionOnly = in_array($user->function, ['Admin', 'Direction']);

    // exemplo de regra (ajusta como quiseres)
    $canChatProfessor = in_array($user->function, ['Professor', 'Admin', 'Direction']);
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

    

</div>
