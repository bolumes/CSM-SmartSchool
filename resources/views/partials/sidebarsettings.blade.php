<!-- Overlay pour fermer le menu en cliquant à l'extérieur -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <!-- Accueil -->
    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span>Accueil
    </a>
    <hr>

    <!-- Statistiques -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
      <span class="icon">📊</span> Statistiques
    </a>
    <div class="submenu">
      <a href="#"><i class="fas fa-search"></i> Salle / Bâtiment</a>
      <a href="#"><i class="fas fa-user-graduate"></i> Professeur / Matière</a>
      <a href="#"><i class="fas fa-calendar-alt"></i> Événement / Salle</a>
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
    </div>
    <hr>

    <!-- Type-Événement -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon">📅</span> Type-Événem
    </a>
    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> Rechercher</a>
        <a href="#"><i class="fas fa-plus"></i> Créer</a>
        <a href="#"><i class="fas fa-list"></i> Lister</a>
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
      <a href="#"><i class="fas fa-user-shield"></i> Admin</a>
      <a href="#"><i class="fas fa-user-plus"></i> Utilisateur</a>
      <a href="#"><i class="fas fa-user-secret"></i> Invité</a>
    </div>
    <hr>

</div>
