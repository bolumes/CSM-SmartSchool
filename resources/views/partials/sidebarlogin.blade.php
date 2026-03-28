
<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<!-- Sidebar -->

<div class="sidebar" id="sidebar">
    <a href="{{ route('home.index')}}"><span class="icon">🏠</span> {{ __('messages.Home') }}</a>
    <hr>
    <a href="{{ route('home.services') }}"><span class="icon">💼</span> {{ __('messages.services') }}</a>
    <hr>
    <a href="{{ route('home.about') }}"><span class="icon">ℹ️</span> {{ __('messages.About') }}</a>
    <hr>
    <a href="{{ route('home.contact') }}"><span class="icon">📞</span> {{ __('messages.Contact') }}</a>
    <hr>
    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
    <span class="icon">🔒</span> {{ __('messages.Login') }}
    </a>
    
</div>