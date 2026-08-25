@php
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | UTILIZADOR AUTENTICADO
    |--------------------------------------------------------------------------
    */

    $isAuthenticated = $user !== null;


    /*
    |--------------------------------------------------------------------------
    | FUNÇÕES
    |--------------------------------------------------------------------------
    */

    $isAdmin = $user && $user->function === 'Admin';

    $isDirection = $user && $user->function === 'Direction';

    $isSeDirection = $user && $user->function === 'Se_Direction';

    $isSeAdministratif = $user && $user->function === 'Se_Administratif';

    $isSeFinancier = $user && $user->function === 'Se_Financier';


    /*
    |--------------------------------------------------------------------------
    | ADMIN / DIRECTION
    |--------------------------------------------------------------------------
    */

    $isAdminOrDirection = $user &&
        in_array($user->function, [
            'Admin',
            'Direction'
        ]);


    /*
    |--------------------------------------------------------------------------
    | GESTÃO DE ANÚNCIOS
    |--------------------------------------------------------------------------
    |
    | Admin
    | Direction
    | Se_Direction
    |
    */

    $canManageAnnouncements = $user &&
        in_array($user->function, [
            'Admin',
            'Direction',
            'Se_Direction'
        ]);


    /*
    |--------------------------------------------------------------------------
    | GESTÃO DA DIREÇÃO
    |--------------------------------------------------------------------------
    |
    | Admin
    | Direction
    | Se_Direction
    |
    */

    $canManageDirection = $user &&
        in_array($user->function, [
            'Admin',
            'Direction',
            'Se_Direction'
        ]);


    /*
    |--------------------------------------------------------------------------
    | PROFESSOR
    |--------------------------------------------------------------------------
    */

    $isProfessor = $user &&
        $user->function === 'Professeur';


    /*
    |--------------------------------------------------------------------------
    | PARENT
    |--------------------------------------------------------------------------
    */

    $isParent = $user &&
        $user->function === 'Parent';


    /*
    |--------------------------------------------------------------------------
    | ELEVE
    |--------------------------------------------------------------------------
    */

    $isEleve = $user &&
        $user->function === 'Eleve';


    /*
    |--------------------------------------------------------------------------
    | CHAT PROFESSOR
    |--------------------------------------------------------------------------
    */

    $canChatProfessor = $user &&
        $user->chat_professor == 1;

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

<div
    class="sidebar"
    id="sidebar"
>


    <!-- =====================================================
         ACCUEIL
    ====================================================== -->

    <a href="{{ route('home.welcome') }}">

        <span class="icon">🏠</span>

        {{ __('messages.Home') }}

    </a>

    <hr>


    <!-- =====================================================
         COMUNICADOS / NEWS
         
         Admin
         Direction
         Se_Direction
    ====================================================== -->

    @if($isAuthenticated)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >

            <span class="icon">📢</span>

            {{ __('messages.News') }}

        </a>


        <div class="submenu">


            <!-- Pesquisar comunicados -->

            <a href="{{ route('anuncios.search') }}">

                <i class="fas fa-search"></i>

                {{ __('messages.Search') }}

            </a>


            <!-- Criar comunicado
                 Admin / Direction / Se_Direction -->

            @if($canManageAnnouncements)

                <a href="{{ route('anuncios.create') }}">

                    <i class="fas fa-plus"></i>

                    {{ __('messages.Create') }}

                </a>

            @endif


            <!-- Lista de comunicados -->

            <a href="{{ route('anuncios.listanuncios') }}">

                <i class="fas fa-list"></i>

                {{ __('messages.List') }}

            </a>

        </div>

        <hr>

    @endif


    <!-- =====================================================
         GESTÃO ACADÉMICA
    ====================================================== -->

    @if($isAuthenticated)

        <a href="{{ route('home.gestacad') }}">

            <span class="icon">📚</span>

            {{ __('messages.Manage') }}

        </a>

        <hr>

    @endif


    <!-- =====================================================
         GESTÃO DE EVENTOS
    ====================================================== -->

    @if($isAuthenticated)

        <a href="{{ route('home.gesteventos') }}">

            <span class="icon">📅</span>

            {{ __('messages.ManageEvents') }}

        </a>

        <hr>

    @endif


    <!-- =====================================================
         GESTÃO CHAT
    ====================================================== -->

    @if($isAuthenticated)

        <a href="{{ route('home.gestchat') }}">

            <span class="icon">💬</span>

            {{ __('messages.ManageChat') }}

        </a>

        <hr>

    @endif


    <!-- =====================================================
         CONFIGURAÇÕES / SETTINGS
         
         Todos os utilizadores autenticados
    ====================================================== -->

    @if($isAuthenticated)

        <a
            class="has-submenu"
            onclick="toggleSubmenu(this)"
        >

            <span class="icon">⚙️</span>

            {{ __('messages.Settings') }}

        </a>


        <div class="submenu">


            <!-- =================================================
                 MEUS DADOS
            ================================================== -->

            <a href="{{ route('users.show', $user->id) }}">

                <i class="fas fa-user"></i>

                Meus dados

            </a>


            <!-- =================================================
                 EDITAR MEUS DADOS
            ================================================== -->

            <a href="{{ route('users.edit', $user->id) }}">

                <i class="fas fa-user-edit"></i>

                Editar meus dados

            </a>


            <!-- =================================================
                 CONFIGURAÇÕES DA CONTA
            ================================================== -->

            <a href="{{ route('home.settings') }}">

                <i class="fas fa-cog"></i>

                {{ __('messages.Settings') }}

            </a>


        </div>

        <hr>

    @endif


    <!-- =====================================================
         ACESSO RÁPIDO
         
         Admin
         Direction
         Se_Direction
    ====================================================== -->

    @if($canManageDirection)

        <a href="{{ route('home.acessrapide') }}">

            <span class="icon">🎯</span>

            {{ __('messages.quickAccess') }}

        </a>

        <hr>

    @endif


    <!-- =====================================================
         LOGOUT
         
         TODOS OS UTILIZADORES AUTENTICADOS
    ====================================================== -->

    @if($isAuthenticated)

        <a
            href="#"
            data-bs-toggle="modal"
            data-bs-target="#logoutModal"
            class="has-submenu"
        >

            <span class="icon">

                <i class="fas fa-power-off"></i>

            </span>

            {{ __('messages.Logout') }}

        </a>

        <hr>

    @endif


</div>


<!-- =========================================================
     JAVASCRIPT DO SIDEBAR
========================================================= -->

<script>


/*
|--------------------------------------------------------------------------
| ABRIR / FECHAR SIDEBAR
|--------------------------------------------------------------------------
*/

function toggleMenu() {

    const sidebar =
        document.getElementById("sidebar");

    const overlay =
        document.getElementById("overlay");


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
| SUBMENU
|--------------------------------------------------------------------------
*/

function toggleSubmenu(element) {

    if (!element) {
        return;
    }


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


/*
|--------------------------------------------------------------------------
| FECHAR AO CLICAR NO OVERLAY
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

</script>