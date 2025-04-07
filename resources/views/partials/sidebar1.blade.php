<!-- Overlay para fechar o menu clicando fora -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <!-- Início -->
    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span>Início
    </a>
    <hr>

    <!-- Estatísticas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">📊</span> Estatísticas

    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-search"></i> Sala / Edificio</a>
      <a href="#"><i class="fas fa-user-graduate"></i> Prof / Matéria</a>
      <a href="#"><i class="fas fa-calendar-alt"></i> Evento / Sala</a>
    </div>
    <hr>


    <!-- Usuário -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">👤</span> Usuário
    </a>
    <div class="submenu">
        <a href="{{ route('users.search') }}"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> Criar</a>
        <a href="{{ route('users.listusers') }}"><i class="fas fa-users"></i> Listar</a>
    </div>
    <hr>

    <!-- Tipo-Evento -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> Tipo-Evento
    </a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Pesquisar</a>
        <a href="#"><i class="fas fa-plus"></i> Criar</a>
        <a href="#"><i class="fas fa-list"></i> Listar</a>
    </div>
    <hr>

    <!-- Disponibilidade Salas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">🚪</span> Dispo-Salas
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-check-circle"></i> Disponível</a>
      <a href="#"><i class="fas fa-times-circle"></i> Indisponível</a>
    </div>
    <hr>

   <!-- Gerar Horário -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">🕒</span> Gerar-Horário
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-building"></i> Por Edificio</a>
      <a href="#"><i class="fas fa-door-open"></i> Por Sala</a>
      <a href="#"><i class="fas fa-chalkboard-teacher"></i> Por Professor</a>
    </div>
    <hr>

    <!-- Gerir Logs -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">⚙️</span> Gerir-Logs
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-user-shield"></i> Admin</a>
      <a href="#"><i class="fas fa-user-plus"></i> User</a>
      <a href="#"><i class="fas fa-user-secret"></i> Guest</a>
    </div>
    <hr>

</div>