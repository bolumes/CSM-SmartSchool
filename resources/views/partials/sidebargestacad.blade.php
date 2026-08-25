@php

$user = auth()->user();

$isAdmin = $user->function === 'Admin';
$isDirection = $user->function === 'Direction';
$isSeDirection = $user->function === 'Se_Direction';
$isSeAdministratif = $user->function === 'Se_Administratif';
$isSeFinancier = $user->function === 'Se_Financier';
$isProfesseur = $user->function === 'Professeur';
$isParent = $user->function === 'Parent';
$isEleve = $user->function === 'Eleve';


/*
|--------------------------------------------------------------------------
| GESTÃO ACADÉMICA
|--------------------------------------------------------------------------
|
| Admin + Secretário Administrativo
|
*/

$canManageAcademic = in_array($user->function, [
    'Admin',
    'Se_Administratif'
]);


/*
|--------------------------------------------------------------------------
| NOTAS
|--------------------------------------------------------------------------
|
| Admin + Secretário Administrativo + Professor
|
*/

$canManageGrades = in_array($user->function, [
    'Admin',
    'Se_Administratif',
    'Professeur'
]);


/*
|--------------------------------------------------------------------------
| ASSIDUIDADE
|--------------------------------------------------------------------------
|
| Admin + Secretário Administrativo + Professor
|
*/

$canManageAttendance = in_array($user->function, [
    'Admin',
    'Se_Administratif',
    'Professeur'
]);


/*
|--------------------------------------------------------------------------
| INSCRIÇÕES
|--------------------------------------------------------------------------
|
| Admin + Secretário Administrativo
|
*/

$canManageInscription = in_array($user->function, [
    'Admin',
    'Se_Administratif'
]);


/*
|--------------------------------------------------------------------------
| CHAT
|--------------------------------------------------------------------------
*/

$canChatParent = $user->chat_parent == 1;
$canChatProfessor = $user->chat_professor == 1;

@endphp

<!-- Overlay pour fermer le menu en cliquant à l'extérieur -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <!-- Accueil -->
    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span> {{ __('messages.Home') }}
    </a>
    <hr>


    <!-- Edifícios -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏢</span> {{ __('messages.buildings') }}</a>
    <div class="submenu">
        <a href="{{ route('edificios.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>

        @if($canManageAcademic)
            <a href="{{ route('edificios.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif

        <a href="{{ route('edificios.listedificios') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>


    <!-- Salas -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">🏫</span> {{ __('messages.Room') }}</a>
    <div class="submenu">
        <a href="{{ route('salas.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>

        @if($canManageAcademic)
            <a href="{{ route('salas.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif

        <a href="{{ route('salas.listsalas') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>


    <!-- Classes -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> {{ __('messages.classes') }}</a>
    <div class="submenu">
        <a href="{{ route('classes.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>

        @if($canManageAcademic)
            <a href="{{ route('classes.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif

        <a href="{{ route('classes.listclasses') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>


    <!-- Matiere -->
    <a class="has-submenu" onclick="toggleSubmenu(this)"><span class="icon">📖</span> {{ __('messages.subjects') }}</a>
    <div class="submenu">
        <a href="{{ route('matieres.search') }}"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>

        @if($canManageAcademic)
            <a href="{{ route('matieres.create') }}"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif

        <a href="{{ route('matieres.listmatieres') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>
    </div>
    <hr>


    <!-- Parents -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-friends"></i></span> {{ __('messages.Parent') }}
    </a>

    <div class="submenu">
        <a href="#"><i class="fas fa-search"></i> {{ __('messages.Search') }}</a>

        @if($canManageAcademic)
            <a href="#"><i class="fas fa-plus"></i> {{ __('messages.Create') }}</a>
        @endif

        <a href="{{ route('parent.listparent') }}"><i class="fas fa-list"></i> {{ __('messages.List') }}</a>

        {{-- Chat Parents --}}
        @if($canChatParent)
            <a href="{{ route('spaces.parent') }}"><i class="fas fa-comments"></i> {{ __('messages.Chat') }}</a>
        @endif
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

        @if($canManageAcademic)
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


    <!-- Élèves -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-graduate"></i></span> {{ __('messages.Student') }}
    </a>

    <div class="submenu">

        <a href="{{ route('eleves.search') }}">
            <i class="fas fa-search"></i> {{ __('messages.Search') }}
        </a>

        @if($canManageAcademic)
            <a href="{{ route('eleves.create') }}">
                <i class="fas fa-user-plus"></i> {{ __('messages.Create') }}
            </a>
        @endif

        <a href="{{ route('eleves.listeleves') }}">
            <i class="fas fa-users"></i> {{ __('messages.List') }}
        </a>

    </div>
    <hr>


    <!-- Inscrições -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-user-graduate"></i></span> {{ __('messages.Inscription') }}
    </a>

    <div class="submenu">

        <a href="#">
            <i class="fas fa-search"></i> {{ __('messages.Search') }}
        </a>

        @if($canManageInscription)
            <a href="{{ route('inscriptions.create') }}">
                <i class="fas fa-user-plus"></i> {{ __('messages.Create') }}
            </a>
        @endif

        <a href="#">
            <i class="fas fa-users"></i> {{ __('messages.List') }}
        </a>

        @if($canManageInscription)
            <a href="{{ route('annees-scolaires.index') }}">
                <i class="fas fa-user-plus"></i> {{ __('messages.Academic Year') }}
            </a>
        @endif

    </div>
    <hr>


    <!-- Notes -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-chart-line"></i></span> {{ __('messages.Grades') }}
    </a>

    <div class="submenu">

        <a href="#">
            <i class="fas fa-search"></i> {{ __('messages.Search') }}
        </a>

        @if($canManageGrades)
            <a href="{{ route('notes.create') }}">
                <i class="fas fa-file-alt"></i> {{ __('messages.Create') }}
            </a>
        @endif

        <a href="{{ route('notes.listenotes') }}">
            <i class="fas fa-address-book"></i> {{ __('messages.List') }}
        </a>

    </div>
    <hr>


    <!-- Falta -->
    <a class="has-submenu" onclick="toggleSubmenu(this)">
        <span class="icon"><i class="fas fa-chart-line"></i></span> {{ __('messages.Attendance') }}
    </a>

    <div class="submenu">

        <a href="#">
            <i class="fas fa-search"></i> {{ __('messages.Search') }}
        </a>

        @if($canManageAttendance)
            <a href="{{ route('attendance.create') }}">
                <i class="fas fa-file-alt"></i> {{ __('messages.Create') }}
            </a>
        @endif

        <a href="{{ route('attendance.listAttendance') }}">
            <i class="fas fa-address-book"></i> {{ __('messages.List') }}
        </a>

    </div>
    <hr>


</div>