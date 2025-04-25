<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProgeventController;

// Prefixo de versão, opcional mas recomendado
Route::prefix('v1')->group(function () {

    // Usuários
    Route::get('/users', [UserController::class, 'listusers']);
    Route::get('/users/search', [UserController::class, 'search']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Edifícios
    Route::get('/edificios', [EdificioController::class, 'listedificios']);
    Route::get('/edificios/search', [EdificioController::class, 'search']);
    Route::get('/edificios/{edificio}', [EdificioController::class, 'show']);
    Route::post('/edificios', [EdificioController::class, 'store']);
    Route::put('/edificios/{edificio}', [EdificioController::class, 'update']);
    Route::delete('/edificios/{edificio}', [EdificioController::class, 'destroy']);

    // Salas
    Route::get('/salas', [SalaController::class, 'listsalas']);
    Route::get('/salas/search', [SalaController::class, 'search']);
    Route::get('/salas/{sala}', [SalaController::class, 'show']);
    Route::post('/salas', [SalaController::class, 'store']);
    Route::put('/salas/{sala}', [SalaController::class, 'update']);
    Route::delete('/salas/{sala}', [SalaController::class, 'destroy']);

    // Classes
    Route::get('/classes', [ClasseController::class, 'listclasses']);
    Route::get('/classes/search', [ClasseController::class, 'search']);
    Route::get('/classes/{classe}', [ClasseController::class, 'show']);
    Route::post('/classes', [ClasseController::class, 'store']);
    Route::put('/classes/{classe}', [ClasseController::class, 'update']);
    Route::delete('/classes/{classe}', [ClasseController::class, 'destroy']);

    // Professores
    Route::get('/professores', [ProfessorController::class, 'listprofessors']);
    Route::get('/professores/search', [ProfessorController::class, 'search']);
    Route::get('/professores/{professor}', [ProfessorController::class, 'show']);
    Route::post('/professores', [ProfessorController::class, 'store']);
    Route::put('/professores/{professor}', [ProfessorController::class, 'update']);
    Route::delete('/professores/{professor}', [ProfessorController::class, 'destroy']);

    // Matérias
    Route::get('/matieres', [MatiereController::class, 'listmatieres']);
    Route::get('/matieres/search', [MatiereController::class, 'search']);
    Route::get('/matieres/{matiere}', [MatiereController::class, 'show']);
    Route::post('/matieres', [MatiereController::class, 'store']);
    Route::put('/matieres/{matiere}', [MatiereController::class, 'update']);
    Route::delete('/matieres/{matiere}', [MatiereController::class, 'destroy']);

    // Eventos
    Route::get('/events', [EventsController::class, 'listevents']);
    Route::get('/events/search', [EventsController::class, 'search']);
    Route::get('/events/{event}', [EventsController::class, 'show']);
    Route::post('/events', [EventsController::class, 'store']);
    Route::put('/events/{event}', [EventsController::class, 'update']);
    Route::delete('/events/{event}', [EventsController::class, 'destroy']);

    // Programação de Eventos
    Route::get('/progevents', [ProgeventController::class, 'listprogevents']);
    Route::get('/progevents/search', [ProgeventController::class, 'search']);
    Route::get('/progevents/{progevent}', [ProgeventController::class, 'show']);
    Route::post('/progevents', [ProgeventController::class, 'store']);
    Route::put('/progevents/{progevent}', [ProgeventController::class, 'update']);
    Route::delete('/progevents/{progevent}', [ProgeventController::class, 'destroy']);

});

// Rota de teste para verificar se a API está funcionando

Route::get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);
});