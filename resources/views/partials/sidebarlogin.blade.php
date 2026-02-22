
<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<!-- Sidebar -->

<div class="sidebar" id="sidebar">
    <a href="{{ route('home.index')}}"><span class="icon">🏠</span> Home</a>
    <hr>
    <a href="{{ route('home.services') }}"><span class="icon">💼</span> Services</a>
    <hr>
    <a href="{{ route('home.about') }}"><span class="icon">ℹ️</span> About us</a>
    <hr>
    <a href="{{ route('home.contact') }}"><span class="icon">📞</span> Contact</a>
    <hr>
    <a href="{{ route('login') }}"><span class="icon">🔒</span> Sign in</a>
    <hr>
</div>