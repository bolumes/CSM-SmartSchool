<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProgeventController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;
use App\Models\Progevent;
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
Route::get('/index0', [UserController::class, 'index0'])->name('home.index0');
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

// Rotas de EdificioController
Route::get('/edificios/search', [EdificioController::class, 'search'])->name('edificios.search');
Route::get('/edificios/create', [EdificioController::class, 'create'])->name('edificios.create');
Route::post('/store-edificio', [EdificioController::class, 'store'])->name('edificio-store');
Route::get('/edificios/listedificios', [EdificioController::class, 'listedificios'])->name('edificios.listedificios');
Route::get('show-edificio/{edificio}', [EdificioController::class, 'show'])->name('edificios.show');
Route::get('/edit-edificio/{edificio}', [EdificioController::class, 'edit'])->name('edificios.edit');
Route::put('/update-edificio/{edificio}', [EdificioController::class, 'update'])->name('edificios.update');
Route::delete('/destroy-edificio/{edificio}', [EdificioController::class, 'destroy'])->name('edificios.destroy');

// Rotas de SalaController
Route::get('/salas/search', [SalaController::class, 'search'])->name('salas.search');
Route::get('/salas/create', [SalaController::class, 'create'])->name('salas.create');
Route::post('/store-sala', [SalaController::class, 'store'])->name('sala-store');
Route::get('/salas/listsalas', [SalaController::class, 'listsalas'])->name('salas.listsalas');
Route::get('show-sala/{sala}', [SalaController::class, 'show'])->name('salas.show');
Route::get('/edit-sala/{sala}', [SalaController::class, 'edit'])->name('salas.edit');
Route::put('/update-sala/{sala}', [SalaController::class, 'update'])->name('salas.update');
Route::delete('/destroy-sala/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy');

// Rotas de ClasseController
Route::get('/classes/search', [ClasseController::class, 'search'])->name('classes.search');
Route::get('/classes/create', [ClasseController::class, 'create'])->name('classes.create');
Route::post('/store-classe', [ClasseController::class, 'store'])->name('classe-store');
Route::get('/classes/listclasses', [ClasseController::class, 'listclasses'])->name('classes.listclasses');
Route::get('show-classe/{classe}', [ClasseController::class, 'show'])->name('classes.show');
Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classes.edit');
Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classes.update');
Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy');

// Rotas de ProfessorController
Route::get('/professores/search', [ProfessorController::class, 'search'])->name('professors.search');
Route::get('/professores/create', [ProfessorController::class, 'create'])->name('professors.create');
Route::post('/store-professor', [ProfessorController::class, 'store'])->name('professor-store');
Route::get('/professores/listprofessores', [ProfessorController::class, 'listprofessors'])->name('professors.listprofessors');
Route::get('show-professor/{professor}', [ProfessorController::class, 'show'])->name('professors.show');
Route::get('/edit-professor/{professor}', [ProfessorController::class, 'edit'])->name('professors.edit');
Route::put('/update-professor/{professor}', [ProfessorController::class, 'update'])->name('professors.update');
Route::delete('/destroy-professor/{professor}', [ProfessorController::class, 'destroy'])->name('professors.destroy');


// Rotas de MatiereController
Route::get('/matieres/search', [MatiereController::class, 'search'])->name('matieres.search');
Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
Route::post('/store-matiere', [MatiereController::class, 'store'])->name('matiere-store');
Route::get('/matieres/listmaterias', [MatiereController::class, 'listmatieres'])->name('matieres.listmatieres');
Route::get('show-matiere/{matiere}', [MatiereController::class, 'show'])->name('matieres.show');
Route::get('/edit-matiere/{matiere}', [MatiereController::class, 'edit'])->name('matieres.edit');
Route::put('/update-matiere/{matiere}', [MatiereController::class, 'update'])->name('matieres.update');
Route::delete('/destroy-matiere/{matiere}', [MatiereController::class, 'destroy'])->name('matieres.destroy');


// Rota para exibir a página de Eventos
Route::get('/events/search', [EventsController::class, 'search'])->name('events.search');
Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
Route::post('/store-event', [EventsController::class, 'store'])->name('event-store');
Route::get('/events/listevents', [EventsController::class, 'listevents'])->name('events.listevents');
Route::get('show-event/{event}', [EventsController::class, 'show'])->name('events.show');
Route::get('/edit-event/{event}', [EventsController::class, 'edit'])->name('events.edit');
Route::put('/update-event/{event}', [EventsController::class, 'update'])->name('events.update');
Route::delete('/destroy-event/{event}', [EventsController::class, 'destroy'])->name('events.destroy');


// Rota para exibir a página de Programar-Eventos
Route::get('/progevents/search', [ProgeventController::class, 'search'])->name('progevents.search');
Route::get('/progevents/create', [ProgeventController::class, 'create'])->name('progevents.create');
Route::post('/store-progevent', [ProgeventController::class, 'store'])->name('progevent-store');
Route::get('/progevents/listprogevents', [ProgeventController::class, 'listprogevents'])->name('progevents.listprogevents');
Route::get('show-progevent/{progevent}', [ProgeventController::class, 'show'])->name('progevents.show');
Route::get('/edit-progevent/{progevent}', [ProgeventController::class, 'edit'])->name('progevents.edit');
Route::put('/update-progevent/{progevent}', [ProgeventController::class, 'update'])->name('progevents.update');
Route::delete('/destroy-progevent/{progevent}', [ProgeventController::class, 'destroy'])->name('progevents.destroy');


require __DIR__.'/auth.php';
