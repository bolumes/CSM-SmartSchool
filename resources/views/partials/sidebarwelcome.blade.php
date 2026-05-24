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

    <!-- Gestao Academica -->
    <a href="{{ route('home.gestacad') }}"><span class="icon">📚</span> {{ __('messages.Manage') }}</a>
    <hr>

    <!-- Gestao Eventos -->
    <a href="{{ route('home.gesteventos') }}"><span class="icon">📅</span> {{ __('messages.ManageEvents') }}</a>
    <hr>

    <!-- Gestao Chat -->
    <a href="{{ route('home.gestchat') }}"><span class="icon">💬</span> {{ __('messages.ManageChat') }}</a>
    <hr>

    
     <!-- Configurações -->
     @if($isAdminOrDirection)
    <a href="{{ route('home.settings') }}"><span class="icon">⚙️</span> {{ __('messages.Settings') }}</a>
    <hr>
    @endif  

    <!-- Acesso Rápido -->
    @if($isAdminOrDirection)
    <a href="{{ route('home.acessrapide') }}"><span class="icon">🎯</span> {{ __('messages.quickAccess') }}</a>
    <hr>
    @endif
    
    <!-- Logout com modal -->
    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="has-submenu">
        <span class="icon"><i class="fas fa-power-off"></i></span> {{ __('messages.Logout') }}
    </a>
    <hr>
    
</div>