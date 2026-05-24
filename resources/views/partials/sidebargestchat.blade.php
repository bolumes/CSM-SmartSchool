@php
$user = auth()->user();

$isAdminOrDirection =
    $user &&
    in_array($user->function, ['Admin', 'Direction']);

$canChatParent = $user?->chat_parent;

$canChatProfessor = $user?->chat_professor;

$canChatAdministration = $user?->chat_direction;

@endphp

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">

    <!-- HOME -->
    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span>
        {{ __('messages.Home') }}
    </a>

    <hr>

    <!-- ===================================================== -->
    <!-- PARENT CHAT -->
    <!-- ===================================================== -->

    @if($canChatParent)

        <a class="has-submenu" onclick="toggleSubmenu(this)">
            <span class="icon">👨‍👩‍👧</span>
            {{ __('messages.Parent') }}
        </a>

        <div class="submenu">

            <!-- GROUP -->
            <a href="{{ route('spaces.parent') }}">
                <i class="fas fa-comments"></i>
                {{ __('messages.Group') }}
            </a>

            <!-- PRIVATE -->
            <a href="#">
                <i class="fas fa-comment-dots"></i>
                {{ __('messages.Private') }}
            </a>

        </div>

        <hr>

    @endif


    <!-- ===================================================== -->
    <!-- PROFESSOR CHAT -->
    <!-- ===================================================== -->

    @if($canChatProfessor)

        <a class="has-submenu" onclick="toggleSubmenu(this)">
            <span class="icon">👨‍🏫</span>
            {{ __('messages.Professor') }}
        </a>

        <div class="submenu">

            <!-- GROUP -->
            <a href="{{ route('spaces.professor') }}">
                <i class="fas fa-comments"></i>
                {{ __('messages.Group') }}
            </a>

            <!-- PRIVATE -->
            <a href="#">
                <i class="fas fa-comment-dots"></i>
                {{ __('messages.Private') }}
            </a>

        </div>

        <hr>

    @endif


    <!-- ===================================================== -->
    <!-- ADMINISTRATION CHAT -->
    <!-- ===================================================== -->

    @if($canChatAdministration)

        <a class="has-submenu" onclick="toggleSubmenu(this)">
            <span class="icon">🏢</span>
            {{ __('messages.Administration') }}
        </a>

        <div class="submenu">

            <!-- GROUP -->
            <a href="#">
                <i class="fas fa-comments"></i>
                {{ __('messages.Group') }}
            </a>

            <!-- PRIVATE -->
            <a href="#">
                <i class="fas fa-comment-dots"></i>
                {{ __('messages.Private') }}
            </a>

        </div>

        <hr>

    @endif

</div>