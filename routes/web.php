<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProgeventController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\SpacePostController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\SpaceCommentController;
use App\Models\Progevent;
use App\Models\SpaceComment;
use Illuminate\Support\Facades\Route;

// Rota de boas-vindas
Route::get('/', function () {
    return view('welcome');
});

// Rota de dashboard com autenticação
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas autenticadas
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rota para o logout (método POST)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/sair', [UserController::class, 'sair'])->name('home.sair');

// Definir a rota de login
//Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/login', [UserController::class, 'login'])->name('home.login');

// Rota para processar o login (POST)
Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');


// Rota para exibir a página de signup
Route::middleware('guest')->get('/signup', [UserController::class, 'signup'])->name('home.signup');

// Rota para salvar o novo usuário signup
Route::post('/store-signup', [UserController::class, 'storeSignup'])->name('user-signup');





Route::get('/login', function () {
    return view('login');
})->name('login');

// Rotas de UserController
Route::get('/contact', [UserController::class, 'contact'])->name('home.contact');
Route::get('/about', [UserController::class, 'about'])->name('home.about');
Route::get('/services', [UserController::class, 'services'])->name('home.services');
Route::get('/', [UserController::class, 'index'])->name('home.index');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
Route::get('/home/settings', [UserController::class, 'settings'])->name('home.settings');
Route::get('/welcome', [UserController::class, 'welcome'])->name('home.welcome');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user-store');
Route::get('/users/listusers', [UserController::class, 'listusers'])->name('users.listusers');
Route::get('show-user/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/edit-users/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/export', [UserController::class, 'export'])->name('users.export');
Route::get('/users/droit', [UserController::class, 'droit'])->name('users.droits');
Route::get('/users/showPermission/{user}', [UserController::class, 'showPermission'])->name('users.showPermission');
Route::put('/users/chatUpdate/{user}', [UserController::class, 'chatUpdate'])->name('users.chatUpdate');

// Rotas de EleveController
Route::get('/eleve/search', [EleveController::class, 'search'])->name('eleve.search');
Route::get('/eleve/listeleve', [EleveController::class, 'listeleve'])->name('eleve.listeleve');
Route::put('/update-eleve/{user}', [EleveController::class, 'update'])->name('eleve.update');
Route::get('show-eleve/{user}', [EleveController::class, 'show'])->name('eleve.show');
Route::get('/edit-eleve/{user}', [EleveController::class, 'edit'])->name('eleve.edit');
Route::post('/eleve/export', [EleveController::class, 'export'])->name('eleve.export');

// Rotas de EdificioControllers
Route::get('/edificios/search', [EdificioController::class, 'search'])->name('edificios.search');
Route::get('/edificios/create', [EdificioController::class, 'create'])->name('edificios.create');
Route::post('/store-edificio', [EdificioController::class, 'store'])->name('edificio-store');
Route::get('/edificios/listedificios', [EdificioController::class, 'listedificios'])->name('edificios.listedificios');
Route::get('show-edificio/{edificio}', [EdificioController::class, 'show'])->name('edificios.show');
Route::get('/edit-edificio/{edificio}', [EdificioController::class, 'edit'])->name('edificios.edit');
Route::put('/update-edificio/{edificio}', [EdificioController::class, 'update'])->name('edificios.update');
Route::delete('/destroy-edificio/{edificio}', [EdificioController::class, 'destroy'])->name('edificios.destroy');
Route::post('/edificios/export', [EdificioController::class, 'export'])->name('edificios.export');

// Rotas de SalaController
Route::get('/salas/search', [SalaController::class, 'search'])->name('salas.search');
Route::get('/salas/create', [SalaController::class, 'create'])->name('salas.create');
Route::post('/store-sala', [SalaController::class, 'store'])->name('sala-store');
Route::get('/salas/listsalas', [SalaController::class, 'listsalas'])->name('salas.listsalas');
Route::get('show-sala/{sala}', [SalaController::class, 'show'])->name('salas.show');
Route::get('/edit-sala/{sala}', [SalaController::class, 'edit'])->name('salas.edit');
Route::put('/update-sala/{sala}', [SalaController::class, 'update'])->name('salas.update');
Route::delete('/destroy-sala/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy');
Route::post('/salas/export', [SalaController::class, 'export'])->name('salas.export');

// Rotas de ClasseController
Route::get('/classes/search', [ClasseController::class, 'search'])->name('classes.search');
Route::get('/classes/create', [ClasseController::class, 'create'])->name('classes.create');
Route::post('/store-classe', [ClasseController::class, 'store'])->name('classe-store');
Route::get('/classes/listclasses', [ClasseController::class, 'listclasses'])->name('classes.listclasses');
Route::get('show-classe/{classe}', [ClasseController::class, 'show'])->name('classes.show');
Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classes.edit');
Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classes.update');
Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy');
Route::post('/classes/export', [ClasseController::class, 'export'])->name('classes.export');

// Rotas de ProfessorController
Route::get('/professores/search', [ProfessorController::class, 'search'])->name('professors.search');
Route::get('/professores/create', [ProfessorController::class, 'create'])->name('professors.create');
Route::post('/store-professor', [ProfessorController::class, 'store'])->name('professor-store');
Route::get('/professores/listprofessores', [ProfessorController::class, 'listprofessors'])->name('professors.listprofessors');
Route::get('show-professor/{professor}', [ProfessorController::class, 'show'])->name('professors.show');
Route::get('/edit-professor/{professor}', [ProfessorController::class, 'edit'])->name('professors.edit');
Route::put('/update-professor/{professor}', [ProfessorController::class, 'update'])->name('professors.update');
Route::delete('/destroy-professor/{professor}', [ProfessorController::class, 'destroy'])->name('professors.destroy');
Route::post('/professores/export', [ProfessorController::class, 'export'])->name('professors.export');  


// Rotas de MatiereController
Route::get('/matieres/search', [MatiereController::class, 'search'])->name('matieres.search');
Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
Route::post('/store-matiere', [MatiereController::class, 'store'])->name('matiere-store');
Route::get('/matieres/listmaterias', [MatiereController::class, 'listmatieres'])->name('matieres.listmatieres');
Route::get('show-matiere/{matiere}', [MatiereController::class, 'show'])->name('matieres.show');
Route::get('/edit-matiere/{matiere}', [MatiereController::class, 'edit'])->name('matieres.edit');
Route::put('/update-matiere/{matiere}', [MatiereController::class, 'update'])->name('matieres.update');
Route::delete('/destroy-matiere/{matiere}', [MatiereController::class, 'destroy'])->name('matieres.destroy');
Route::post('/matieres/export', [MatiereController::class, 'export'])->name('matieres.export');


// Rota para exibir a página de Eventos
Route::get('/events/search', [EventsController::class, 'search'])->name('events.search');
Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
Route::post('/store-event', [EventsController::class, 'store'])->name('event-store');
Route::get('/events/listevents', [EventsController::class, 'listevents'])->name('events.listevents');
Route::get('show-event/{event}', [EventsController::class, 'show'])->name('events.show');
Route::get('/edit-event/{event}', [EventsController::class, 'edit'])->name('events.edit');
Route::put('/update-event/{event}', [EventsController::class, 'update'])->name('events.update');
Route::delete('/destroy-event/{event}', [EventsController::class, 'destroy'])->name('events.destroy');
Route::post('/events/export', [EventsController::class, 'export'])->name('events.export');


// Rota para exibir a página de Programar-Eventos
Route::get('/progevents/search', [ProgeventController::class, 'search'])->name('progevents.search');
Route::get('/progevents/create', [ProgeventController::class, 'create'])->name('progevents.create');
Route::post('/store-progevent', [ProgeventController::class, 'store'])->name('progevent-store');
Route::get('/progevents/listprogevents', [ProgeventController::class, 'listprogevents'])->name('progevents.listprogevents');
Route::get('show-progevent/{progevent}', [ProgeventController::class, 'show'])->name('progevents.show');
Route::get('/edit-progevent/{progevent}', [ProgeventController::class, 'edit'])->name('progevents.edit');
Route::put('/update-progevent/{progevent}', [ProgeventController::class, 'update'])->name('progevents.update');
Route::delete('/destroy-progevent/{progevent}', [ProgeventController::class, 'destroy'])->name('progevents.destroy');
Route::post('/progevents/export', [ProgeventController::class, 'export'])->name('progevents.export');

// Rota para exibir a pagina de Estatisticas
Route::get('/estatisticas/salas-por-edificio', [StatisticsController::class, 'salasPorEdificio'])->name('estatistics.salasporedificio');
Route::get('/estatisticas/docentes-por-formacao', [StatisticsController::class, 'professorPorMatiere'])->name('estatistics.professorpormatiere');
Route::get('/estatisticas/eventos-por-sala', [StatisticsController::class, 'eventosPorSala'])->name('estatistics.eventosporsala');

// Rota para exibir a pagina de Anuncios
Route::get('/anuncios', [AnuncioController::class, 'anuncios'])->name('anuncios.anuncios');
Route::get('/anuncios/create', [AnuncioController::class, 'create'])->name('anuncios.create');
Route::post('/anuncios/store', [AnuncioController::class, 'store'])->name('anuncios.store');
Route::get('/anuncios/edit/{id}', [AnuncioController::class, 'edit'])->name('anuncios.edit');
Route::put('/anuncios/update/{anuncio}', [AnuncioController::class, 'update'])->name('anuncios.update');
Route::delete('/anuncios/destroy/{anuncio}', [AnuncioController::class, 'destroy'])->name('anuncios.destroy');
Route::get('/anuncios/show/{id}', [AnuncioController::class, 'show'])->name('anuncios.show');
Route::get('/anuncios/search', [AnuncioController::class, 'search'])->name('anuncios.search');
Route::get('/anuncios/list', [AnuncioController::class, 'listAnuncio'])->name('anuncios.listanuncios');
Route::post('/anuncios/export', [AnuncioController::class, 'export'])->name('anuncios.export');

// Rota para exibir a página de UserLog
Route::middleware(['auth'])->group(function () {
    Route::get('/userlogs/admin', [UserLogController::class, 'adminLogs'])->name('userlogs.admin');
    Route::get('/userlogs/direction', [UserLogController::class, 'directionLogs'])->name('userlogs.direction');
    Route::get('/userlogs/professeur', [UserLogController::class, 'professeurLogs'])->name('userlogs.professeur');
    Route::get('/userlogs/parent', [UserLogController::class, 'parentLogs'])->name('userlogs.parent');
    Route::get('/userlogs/eleve', [UserLogController::class, 'eleveLogs'])->name('userlogs.eleve');
});

// Chat geral dos professores
Route::middleware('auth')->get('/spaces/professores-chat', [SpaceController::class, 'showProfessorChat'])->name('spaces.professores.chat');


// Rotas para gerenciamento de espaços, mensagens e comentários
   Route::middleware('auth')->group(function () {

    // Lista de espaços
    Route::get('/spaces', [SpaceController::class, 'lista'])->name('spaces.lista');

    // Criar espaço
    Route::get('/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');
    Route::post('/spaces', [SpaceController::class, 'store'])->name('spaces.store');

    // Editar espaço
    Route::get('/spaces/{space}/edit', [SpaceController::class, 'edit'])->name('spaces.edit');
    Route::put('/spaces/{space}', [SpaceController::class, 'update'])->name('spaces.update');

    // Mostrar espaço individual (com posts e comentários)
    Route::get('/spaces/{space}', [SpaceController::class, 'show'])->name('spaces.show');

    // Deletar espaço
    Route::delete('/spaces/{space}', [SpaceController::class, 'destroy'])->name('spaces.destroy');

    // Mensagens (posts)
    Route::post('/spaces/{space}/message', [SpacePostController::class, 'store'])->name('spaces.message.store');

    // Comentários
    Route::post('/posts/{post}/comment', [SpaceCommentController::class, 'store'])->name('posts.comment.store');
});





require __DIR__.'/auth.php';
