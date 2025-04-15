
<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <a href="{{ route('home.index0')}}"><span class="icon">🏠</span> Acceuil</a>
    <hr>
    <a href="{{ route('home.services') }}"><span class="icon">💼</span> Services</a>
    <hr>
    <a href="{{ route('home.about') }}"><span class="icon">ℹ️</span> About-Us</a>
    <hr>
    <a href="{{ route('home.contact') }}"><span class="icon">📞</span> Contato</a>
    <hr>
    <a href="{{ route('login') }}">🔒<span class="icon"></span> Login</a>
    <hr>
</div>
