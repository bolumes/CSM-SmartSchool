@php
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | VERIFICAÇÃO DO UTILIZADOR AUTENTICADO
    |--------------------------------------------------------------------------
    */

    $isAdmin = $user && $user->function === 'Admin';

    $isDirection = $user && $user->function === 'Direction';

    $isAdminOrDirection = $user &&
        in_array($user->function, ['Admin', 'Direction']);

    $isProfessor = $user && $user->function === 'Professeur';

    $isParent = $user && $user->function === 'Parent';

    $isEleve = $user && $user->function === 'Eleve';

    /*
    |--------------------------------------------------------------------------
    | TODOS OS UTILIZADORES AUTENTICADOS
    |--------------------------------------------------------------------------
    */

    $isAuthenticated = $user !== null;
@endphp


<!-- =========================================================
     OVERLAY
========================================================= -->

<div
    class="overlay"
    id="overlay"
    onclick="toggleMenu()"
></div>


<!-- =========================================================
     SIDEBAR
========================================================= -->

<div class="sidebar" id="sidebar">


    <!-- =====================================================
         ACCUEIL / HOME
    ====================================================== -->

    <a href="{{ route('home.welcome') }}">
        <span class="icon">🏠</span>
        {{ __('messages.Home') }}
    </a>

    <hr>


    <!-- =====================================================
         UTILISATEURS
         APENAS ADMIN E DIRECTION
    ====================================================== -->

    @if($isAdminOrDirection)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >
            <span class="icon">👤</span>
            {{ __('messages.User') }}
        </a>

        <div class="submenu">

            <!-- Pesquisar utilizadores -->
            <a href="{{ route('users.search') }}">
                <i class="fas fa-search"></i>
                {{ __('messages.Search') }}
            </a>


            <!-- Criar utilizador -->
            <a href="{{ route('users.create') }}">
                <i class="fas fa-user-plus"></i>
                {{ __('messages.Create') }}
            </a>


            <!-- Lista de utilizadores -->
            <a href="{{ route('users.listusers') }}">
                <i class="fas fa-users"></i>
                {{ __('messages.List') }}
            </a>


            <!-- Direitos -->
            <a href="{{ route('users.droits') }}">
                <i class="fas fa-key"></i>
                {{ __('messages.Rights') }}
            </a>

        </div>

        <hr>

    @endif


    <!-- =====================================================
         PERMISSIONS
         APENAS ADMIN E DIRECTION
    ====================================================== -->

    @if($isAdminOrDirection)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >
            <span class="icon">
                <i class="fas fa-shield-alt"></i>
            </span>

            {{ __('messages.Permissions') }}
        </a>


        <div class="submenu">

            <!-- Direction -->
            <a href="{{ route('users.droitDirection') }}">
                <i class="fas fa-key"></i>
                {{ __('messages.Direction') }}
            </a>


            <!-- Professor -->
            <a href="{{ route('users.droitProfessor') }}">
                <i class="fas fa-key"></i>
                {{ __('messages.Professor') }}
            </a>


            <!-- Parent -->
            <a href="{{ route('users.droitParent') }}">
                <i class="fas fa-key"></i>
                {{ __('messages.Parent') }}
            </a>


            <!-- Eleve -->
            <a href="{{ route('users.droitEleve') }}">
                <i class="fas fa-key"></i>
                {{ __('messages.Student') }}
            </a>

        </div>

        <hr>

    @endif


    <!-- =====================================================
         ESTATÍSTICAS
         TODOS PODEM VER
         (Se quiser restringir depois, podemos alterar)
    ====================================================== -->

    @if($isAuthenticated)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >
            <span class="icon">📊</span>

            {{ __('messages.statistics') }}
        </a>


        <div class="submenu">

            <!-- Sala / Edifício -->
            <a href="{{ route('estatistics.salasporedificio') }}">
                <i class="fas fa-search"></i>
                Salle / Bâtiment
            </a>


            <!-- Professor / Matéria -->
            <a href="{{ route('estatistics.professorpormatiere') }}">
                <i class="fas fa-user-graduate"></i>
                Professeur / Matière
            </a>


            <!-- Eventos / Sala -->
            <a href="{{ route('estatistics.eventosporsala') }}">
                <i class="fas fa-calendar-alt"></i>
                Événement / Salle
            </a>

        </div>

        <hr>

    @endif


    <!-- =====================================================
         LOGS
         APENAS ADMIN E DIRECTION
    ====================================================== -->

    @if($isAdminOrDirection)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >

            <span class="icon">⚙️</span>

            {{ __('messages.Logs') }}

        </a>


        <div class="submenu">

            <!-- Logs Admin -->
            <a
                href="{{ route('userlogs.admin') }}"
                title="Ver logs de Admin"
            >
                <i class="fas fa-user-shield"></i>
                Admin
            </a>


            <!-- Logs Direction -->
            <a
                href="{{ route('userlogs.direction') }}"
                title="Ver logs da Direção"
            >
                <i class="fas fa-chalkboard-teacher"></i>
                {{ __('messages.Direction') }}
            </a>


            <!-- Logs Professor -->
            <a
                href="{{ route('userlogs.professeur') }}"
                title="Ver logs de Professores"
            >
                <i class="fas fa-user-graduate"></i>
                {{ __('messages.Professor') }}
            </a>


            <!-- Logs Parent -->
            <a
                href="{{ route('userlogs.parent') }}"
                title="Ver logs dos Pais"
            >
                <i class="fas fa-user-friends"></i>
                {{ __('messages.Parent') }}
            </a>


            <!-- Logs Eleve -->
            <a
                href="{{ route('userlogs.eleve') }}"
                title="Ver logs dos Alunos"
            >
                <i class="fas fa-user"></i>
                {{ __('messages.Student') }}
            </a>

        </div>

        <hr>

    @endif


    <!-- =====================================================
         SETTINGS
         VISÍVEL PARA TODOS OS UTILIZADORES
    ====================================================== -->

    @if($isAuthenticated)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >

            <span class="icon">
                ⚙️
            </span>

            Settings

        </a>


        <div class="submenu">

            <!-- =================================================
                 MEUS DADOS
            ================================================== -->

            <a href="{{ route('users.show', $user->id) }}">

                <i class="fas fa-user"></i> Dados </a>


            <!-- =================================================
                 EDITAR MEUS DADOS
            ================================================== -->

            <a href="{{ route('users.edit', $user->id) }}">

                <i class="fas fa-user-edit"></i> Editar </a>


            <!-- =================================================
                 MINHA CONTA
            ================================================== -->

            <a href="{{ route('home.settings') }}">

                <i class="fas fa-cog"></i>

                Configurações

            </a>


            <!-- =================================================
                 SAIR
            ================================================== -->

            <a href="{{ route('home.sair') }}">

                <i class="fas fa-sign-out-alt"></i>

                Sair

            </a>

        </div>

        <hr>

    @endif


</div>


<!-- =========================================================
     JAVASCRIPT DO MENU
========================================================= -->

<script>

function toggleMenu() {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (!sidebar || !overlay) {
        console.error(
            "Sidebar ou overlay não encontrados no DOM"
        );

        return;
    }

    sidebar.classList.toggle("open");

    overlay.classList.toggle("active");
}


/*
|--------------------------------------------------------------------------
| FECHAR MENU CLICANDO NO OVERLAY
|--------------------------------------------------------------------------
*/

document.addEventListener(
    "DOMContentLoaded",
    function () {

        const overlay =
            document.getElementById("overlay");

        const sidebar =
            document.getElementById("sidebar");


        if (overlay && sidebar) {

            overlay.addEventListener(
                "click",
                function () {

                    sidebar.classList.remove("open");

                    overlay.classList.remove("active");

                }
            );

        }

    }
);


/*
|--------------------------------------------------------------------------
| SUBMENU
|--------------------------------------------------------------------------
*/

function toggleSubmenu(element) {

    element.classList.toggle("open");

    const submenu =
        element.nextElementSibling;


    if (!submenu) {
        return;
    }


    if (submenu.style.display === "flex") {

        submenu.style.display = "none";

    } else {

        submenu.style.display = "flex";

    }

}

</script>