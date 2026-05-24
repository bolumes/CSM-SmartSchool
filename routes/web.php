<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProgeventController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\SpacePostController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SpaceCommentController;
use Illuminate\Support\Facades\Route;

// ==================== ROTAS PÚBLICAS ====================
Route::get('/', [UserController::class, 'index'])->name('home.index');

// Login/Registro
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.submit');
Route::post('/register', [UserController::class, 'storeSignup'])->name('register');
Route::get('/sair', [UserController::class, 'sair'])->name('home.sair');

// Páginas informativas (públicas)
Route::get('/contact', [UserController::class, 'contact'])->name('home.contact');
Route::get('/about', [UserController::class, 'about'])->name('home.about');
Route::get('/services', [UserController::class, 'services'])->name('home.services');

// ==================== ROTAS PROTEGIDAS (auth) ====================
Route::middleware(['auth'])->group(function () {

    // Dashboard / Home
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/welcome', [UserController::class, 'welcome'])->name('home.welcome');
    Route::get('/home/settings', [UserController::class, 'settings'])->name('home.settings');
    Route::get('/home/gestacad', [UserController::class, 'gestacad'])->name('home.gestacad');
    Route::get('/home/gesteventos', [UserController::class, 'gesteventos'])->name('home.gesteventos');
    Route::get('/home/gestchat', [UserController::class, 'gestchat'])->name('home.gestchat');
    Route::get('/home/acessrapide', [UserController::class, 'acessrapide'])->name('home.acessrapide');
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/listusers', [UserController::class, 'listusers'])->name('users.listusers');
    Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/export', [UserController::class, 'export'])->name('users.export');

    // Rotas de direitos dos usuários
    Route::get('/users/droit', [UserController::class, 'droit'])->name('users.droits');
    Route::get('/users/droitDirection', [UserController::class, 'droitDirection'])->name('users.droitDirection');
    Route::get('/users/droitParent', [UserController::class, 'droitParent'])->name('users.droitParent');
    Route::get('/users/droitEleve', [UserController::class, 'droitEleve'])->name('users.droitEleve');
    Route::get('/users/droitProfessor', [UserController::class, 'droitProfessor'])->name('users.droitProfessor');
    Route::get('/users/showPermission/{user}', [UserController::class, 'showPermission'])->name('users.showPermission');
    Route::get('/users/showPerDirection/{user}', [UserController::class, 'showPerDirection'])->name('users.showPerDirection');
    Route::get('/users/showPerParent/{user}', [UserController::class, 'showPerParent'])->name('users.showPerParent');
    Route::get('/users/showPerEleve/{user}', [UserController::class, 'showPerEleve'])->name('users.showPerEleve');
    Route::get('/users/showPerProfessor/{user}', [UserController::class, 'showPerProfessor'])->name('users.showPerProfessor');
    Route::put('/users/chatUpdate/{user}', [UserController::class, 'chatUpdate'])->name('users.chatUpdate');

    // Alunos
    Route::get('/eleve/search', [EleveController::class, 'search'])->name('eleves.search');
    Route::get('/eleve/create', [EleveController::class, 'create'])->name('eleves.create');
    Route::post('/eleve/store', [EleveController::class, 'store'])->name('eleves.store');
    Route::get('/eleve/listeleve', [EleveController::class, 'listeleve'])->name('eleves.listeleve');
    Route::put('/eleve/update/{user}', [EleveController::class, 'update'])->name('eleves.update');
    Route::get('/eleve/show/{user}', [EleveController::class, 'show'])->name('eleves.show');
    Route::get('/eleve/edit/{user}', [EleveController::class, 'edit'])->name('eleves.edit');
    Route::post('/eleve/export', [EleveController::class, 'export'])->name('eleves.export');

    // Notas
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');

    // Responsáveis
    Route::get('/parent/search', [ParentController::class, 'search'])->name('parent.search');
    Route::get('/parent/listparent', [ParentController::class, 'listparents'])->name('parent.listparent');
    Route::put('/parent/update/{user}', [ParentController::class, 'update'])->name('parent.update');
    Route::get('/parent/show/{user}', [ParentController::class, 'show'])->name('parent.show');
    Route::get('/parent/edit/{user}', [ParentController::class, 'edit'])->name('parent.edit');
    Route::post('/parent/export', [ParentController::class, 'export'])->name('parent.export');

    // Edifícios
    Route::get('/edificios/search', [EdificioController::class, 'search'])->name('edificios.search');
    Route::get('/edificios/create', [EdificioController::class, 'create'])->name('edificios.create');
    Route::post('/edificios/store', [EdificioController::class, 'store'])->name('edificios.store');
    Route::get('/edificios/listedificios', [EdificioController::class, 'listedificios'])->name('edificios.listedificios');
    Route::get('/edificios/show/{edificio}', [EdificioController::class, 'show'])->name('edificios.show');
    Route::get('/edificios/edit/{edificio}', [EdificioController::class, 'edit'])->name('edificios.edit');
    Route::put('/edificios/update/{edificio}', [EdificioController::class, 'update'])->name('edificios.update');
    Route::delete('/edificios/destroy/{edificio}', [EdificioController::class, 'destroy'])->name('edificios.destroy');
    Route::post('/edificios/export', [EdificioController::class, 'export'])->name('edificios.export');

    // Salas
    Route::get('/salas/search', [SalaController::class, 'search'])->name('salas.search');
    Route::get('/salas/create', [SalaController::class, 'create'])->name('salas.create');
    Route::post('/salas/store', [SalaController::class, 'store'])->name('salas.store');
    Route::get('/salas/listsalas', [SalaController::class, 'listsalas'])->name('salas.listsalas');
    Route::get('/salas/show/{sala}', [SalaController::class, 'show'])->name('salas.show');
    Route::get('/salas/edit/{sala}', [SalaController::class, 'edit'])->name('salas.edit');
    Route::put('/salas/update/{sala}', [SalaController::class, 'update'])->name('salas.update');
    Route::delete('/salas/destroy/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy');
    Route::post('/salas/export', [SalaController::class, 'export'])->name('salas.export');

    // Classes
    Route::get('/classes/search', [ClasseController::class, 'search'])->name('classes.search');
    Route::get('/classes/create', [ClasseController::class, 'create'])->name('classes.create');
    Route::post('/classes/store', [ClasseController::class, 'store'])->name('classes.store');
    Route::get('/classes/listclasses', [ClasseController::class, 'listclasses'])->name('classes.listclasses');
    Route::get('/classes/show/{classe}', [ClasseController::class, 'show'])->name('classes.show');
    Route::get('/classes/edit/{classe}', [ClasseController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/update/{classe}', [ClasseController::class, 'update'])->name('classes.update');
    Route::delete('/classes/destroy/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy');
    Route::post('/classes/export', [ClasseController::class, 'export'])->name('classes.export');

    // Professores
    Route::get('/professores/search', [ProfessorController::class, 'search'])->name('professors.search');
    Route::get('/professores/create', [ProfessorController::class, 'create'])->name('professors.create');
    Route::post('/professores/store', [ProfessorController::class, 'store'])->name('professors.store');
    Route::get('/professores/listprofessores', [ProfessorController::class, 'listprofessors'])->name('professors.listprofessors');
    Route::get('/professores/show/{professor}', [ProfessorController::class, 'show'])->name('professors.show');
    Route::get('/professores/edit/{professor}', [ProfessorController::class, 'edit'])->name('professors.edit');
    Route::put('/professores/update/{professor}', [ProfessorController::class, 'update'])->name('professors.update');
    Route::delete('/professores/destroy/{professor}', [ProfessorController::class, 'destroy'])->name('professors.destroy');
    Route::post('/professores/export', [ProfessorController::class, 'export'])->name('professors.export');

    // Disciplinas
    Route::get('/matieres/search', [MatiereController::class, 'search'])->name('matieres.search');
    Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
    Route::post('/matieres/store', [MatiereController::class, 'store'])->name('matieres.store');
    Route::get('/matieres/listmaterias', [MatiereController::class, 'listmatieres'])->name('matieres.listmatieres');
    Route::get('/matieres/show/{matiere}', [MatiereController::class, 'show'])->name('matieres.show');
    Route::get('/matieres/edit/{matiere}', [MatiereController::class, 'edit'])->name('matieres.edit');
    Route::put('/matieres/update/{matiere}', [MatiereController::class, 'update'])->name('matieres.update');
    Route::delete('/matieres/destroy/{matiere}', [MatiereController::class, 'destroy'])->name('matieres.destroy');
    Route::post('/matieres/export', [MatiereController::class, 'export'])->name('matieres.export');

    // Eventos
    Route::get('/events/search', [EventsController::class, 'search'])->name('events.search');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventsController::class, 'store'])->name('events.store');
    Route::get('/events/listevents', [EventsController::class, 'listevents'])->name('events.listevents');
    Route::get('/events/show/{event}', [EventsController::class, 'show'])->name('events.show');
    Route::get('/events/edit/{event}', [EventsController::class, 'edit'])->name('events.edit');
    Route::put('/events/update/{event}', [EventsController::class, 'update'])->name('events.update');
    Route::delete('/events/destroy/{event}', [EventsController::class, 'destroy'])->name('events.destroy');
    Route::post('/events/export', [EventsController::class, 'export'])->name('events.export');

    // Programação de Eventos
    Route::get('/progevents/search', [ProgeventController::class, 'search'])->name('progevents.search');
    Route::get('/progevents/create', [ProgeventController::class, 'create'])->name('progevents.create');
    Route::post('/progevents/store', [ProgeventController::class, 'store'])->name('progevents.store');
    Route::get('/progevents/listprogevents', [ProgeventController::class, 'listprogevents'])->name('progevents.listprogevents');
    Route::get('/progevents/show/{progevent}', [ProgeventController::class, 'show'])->name('progevents.show');
    Route::get('/progevents/edit/{progevent}', [ProgeventController::class, 'edit'])->name('progevents.edit');
    Route::put('/progevents/update/{progevent}', [ProgeventController::class, 'update'])->name('progevents.update');
    Route::delete('/progevents/destroy/{progevent}', [ProgeventController::class, 'destroy'])->name('progevents.destroy');
    Route::post('/progevents/export', [ProgeventController::class, 'export'])->name('progevents.export');

    // Alunos
    Route::get('/eleves/search', [EleveController::class, 'search'])->name('eleves.search');
    Route::get('/eleves/create', [EleveController::class, 'create'])->name('eleves.create');
    Route::post('/eleves/store', [EleveController::class, 'store'])->name('eleves.store');
    Route::get('/eleves/listeleves', [EleveController::class, 'listeleves'])->name('eleves.listeleves');
    Route::get('/eleves/show/{eleve}', [EleveController::class, 'show'])->name('eleves.show');
    Route::get('/eleves/edit/{eleve}', [EleveController::class, 'edit'])->name('eleves.edit');
    Route::put('/eleves/update/{eleve}', [EleveController::class, 'update'])->name('eleves.update');
    Route::delete('/eleves/destroy/{eleve}', [EleveController::class, 'destroy'])->name('eleves.destroy');
    Route::post('/eleves/export', [EleveController::class, 'export'])->name('eleves.export');
    Route::get('/eleves-by-classe/{id}', [EleveController::class, 'getElevesByClasse']);
    Route::get('/listenotes', [EleveController::class, 'index'])->name('notes.listenotes');
    Route::get('/eleves/{id}/notes', [EleveController::class, 'notes'])->name('notes.notesEleves');
    Route::get('/eleves/{id}/export-boletim', [EleveController::class, 'exportBoletim'])->name('eleves.exportBoletim');
    
    // Notas
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/matieres-by-niveau/{niveau}', [MatiereController::class, 'getMatieresByNiveau']);
    Route::get('/notes', [NoteController::class, 'listenotes'])->name('notes.listenotes');
    Route::get('/eleves/{id}/notes/edit', [NoteController::class, 'editByEleve']);
    Route::post('/eleves/{id}/notes/update', [NoteController::class, 'updateByEleve']);

    // Pais
    Route::get('/parents/search', [ParentController::class, 'search'])->name('parents.search');
    Route::get('/parents/create', [ParentController::class, 'create'])->name('parents.create');
    Route::post('/parents/store', [ParentController::class, 'store'])->name('parents.store');
    Route::get('/parents/listparents', [ParentController::class, 'listparents'])->name('parents.listparents');
    Route::get('/parents/show/{parent}', [ParentController::class, 'show'])->name('parents.show');
    Route::get('/parents/edit/{parent}', [ParentController::class, 'edit'])->name('parents.edit');
    Route::put('/parents/update/{parent}', [ParentController::class, 'update'])->name('parents.update');
    Route::delete('/parents/destroy/{parent}', [ParentController::class, 'destroy'])->name('parents.destroy');  
    Route::post('/parents/export', [ParentController::class, 'export'])->name('parents.export');

    // Estatísticas
    Route::get('/estatisticas/salas-por-edificio', [StatisticsController::class, 'salasPorEdificio'])->name('estatistics.salasporedificio');
    Route::get('/estatisticas/docentes-por-formacao', [StatisticsController::class, 'professorPorMatiere'])->name('estatistics.professorpormatiere');
    Route::get('/estatisticas/eventos-por-sala', [StatisticsController::class, 'eventosPorSala'])->name('estatistics.eventosporsala');

    // Anúncios
    Route::get('/anuncios', [AnuncioController::class, 'anuncios'])->name('anuncios.anuncios');
    Route::get('/anuncios/create', [AnuncioController::class, 'create'])->name('anuncios.create');
    Route::post('/anuncios/store', [AnuncioController::class, 'store'])->name('anuncios.store');
    Route::get('/anuncios/edit/{id}', [AnuncioController::class, 'edit'])->name('anuncios.edit');
    Route::put('/anuncios/update/{anuncio}', [AnuncioController::class, 'update'])->name('anuncios.update');
    Route::delete('/anuncios/destroy/{anuncio}', [AnuncioController::class, 'destroy'])->name('anuncios.destroy');
    Route::get('/anuncios/show/{id}', [AnuncioController::class, 'show'])->name('anuncios.show');
    Route::get('/anuncios/search', [AnuncioController::class, 'search'])->name('anuncios.search');
    Route::get('/anuncios/anuncios/list', [AnuncioController::class, 'listAnuncio'])->name('anuncios.listanuncios');
    Route::post('/anuncios/export', [AnuncioController::class, 'export'])->name('anuncios.export');

    // Logs de Usuário
    Route::get('/userlogs/admin', [UserLogController::class, 'adminLogs'])->name('userlogs.admin');
    Route::get('/userlogs/direction', [UserLogController::class, 'directionLogs'])->name('userlogs.direction');
    Route::get('/userlogs/professeur', [UserLogController::class, 'professeurLogs'])->name('userlogs.professeur');
    Route::get('/userlogs/parent', [UserLogController::class, 'parentLogs'])->name('userlogs.parent');
    Route::get('/userlogs/eleve', [UserLogController::class, 'eleveLogs'])->name('userlogs.eleve');

    // Espaços (Chats)
    Route::get('/spaces', [SpaceController::class, 'lista'])->name('spaces.lista');
    Route::get('/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');
    Route::post('/spaces', [SpaceController::class, 'store'])->name('spaces.store');

    // Rotas fixas (devem vir antes da rota dinâmica)
    Route::get('/spaces/professor-chat', [SpaceController::class, 'showProfessorChat'])->name('spaces.professor');
    Route::get('/spaces/parents-chat', [SpaceController::class, 'showParentChat'])->name('spaces.parent');

    // Rotas com parâmetros dinâmicos
    Route::get('/spaces/{space}/edit', [SpaceController::class, 'edit'])->name('spaces.edit');
    Route::put('/spaces/{space}', [SpaceController::class, 'update'])->name('spaces.update');
    Route::get('/spaces/{space}', [SpaceController::class, 'show'])->name('spaces.show');
    Route::delete('/spaces/{space}', [SpaceController::class, 'destroy'])->name('spaces.destroy');

    // Rotas de mensagens e comentários
    Route::post('/spaces/{space}/message', [SpacePostController::class, 'store'])->name('spaces.message.store');
    Route::post('/spaces/posts/{post}/comment', [SpaceCommentController::class, 'store'])->name('spaces.comment.store');
        
});

// Rota de logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';