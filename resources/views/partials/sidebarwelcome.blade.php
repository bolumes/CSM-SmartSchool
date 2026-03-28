@php
$user = auth()->user();
$isAdminOrDirection = false;
$canChatProfessor = false;

if ($user) {
    $isAdminOrDirection = in_array($user->function, ['Admin', 'Direction']);
    $canChatProfessor = $user->chat_professor == 1;
}
@endphp

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <a href="{{ route('home.welcome') }}"><span class="icon">🏠</span> {{ __('messages.Home') }}</a>
    <hr>

     <!-- Comunicados -->
     <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📢</span> {{ __('messages.News') }}</a>
     <div class="submenu">
         <a href="{{ route('anuncios.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
         @if($isAdminOrDirection)
             <a href="{{ route('anuncios.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
         @endif
         <a href="{{ route('anuncios.listanuncios') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
     </div>
     <hr>
 

    <!-- Edifícios -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏢</span> {{ __('messages.buildings') }}</a>
    <div class="submenu">
        <a href="{{ route('edificios.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        @if($isAdminOrDirection)
            <a href="{{ route('edificios.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif
        <a href="{{ route('edificios.listedificios') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>

    <!-- Salas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏫</span> {{ __('messages.Room') }}</a>
    <div class="submenu">
        <a href="{{ route('salas.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        @if($isAdminOrDirection)
            <a href="{{ route('salas.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif
        <a href="{{ route('salas.listsalas') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>

    <!-- Classes -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> {{ __('messages.classes') }}</a>
    <div class="submenu">
        <a href="{{ route('classes.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        @if($isAdminOrDirection)
            <a href="{{ route('classes.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif
        <a href="{{ route('classes.listclasses') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>

    <!-- Matiere -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> {{ __('messages.subjects') }}</a>
    <div class="submenu">
        <a href="{{ route('matieres.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>
        @if($isAdminOrDirection)
            <a href="{{ route('matieres.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif
        <a href="{{ route('matieres.listmatieres') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>

    <!-- Professores -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">👨‍🏫</span> {{ __('messages.Professor') }}
    </a>

    <div class="submenu">

        <a href="{{ route('professors.search') }}">
            <i class="fas fa-search"></i> {{ __('messages.Search') }}
        </a>

        @if($isAdminOrDirection)
            <a href="{{ route('professors.create') }}">
                <i class="fas fa-plus"></i> {{ __('messages.Create') }}
            </a>
        @endif

        <a href="{{ route('professors.listprofessors') }}">
            <i class="fas fa-list"></i> {{ __('messages.List') }}
        </a>

        @if($canChatProfessor)
            <a href="{{ route('spaces.professor') }}">
                <i class="fas fa-comments"></i> {{ __('messages.Chat') }}
            </a>
        @endif

    </div>

    <hr>


    <!-- Configurações -->
    <a href="{{ route('home.settings') }}"><span class="icon">⚙️</span> {{ __('messages.Settings') }}</a>
    <hr>

    
    <!-- Logout com modal -->
    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="has-submenu">
        <span class="icon"><i class="fas fa-power-off"></i></span> {{ __('messages.Logout') }}
    </a>
        <hr>
</div>
