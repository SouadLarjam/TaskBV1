<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\ArchiveController;


// routes public
Route::post('/inscrire',[AuthController::class, 'inscrire']);
Route::post('/connecter',[AuthController::class, 'connecter']);

// Routes API securisees par Sanctum
Route::middleware('auth:sanctum')->group(function() {

    // Afficher les taches de l'utilisateur connecte
    Route::get('/tasks', [TaskController::class, 'index']);

    // Creer une nouvelle tache
    Route::post('/tasks', [TaskController::class, 'cree']);

    // Modifier une tache specifique
    Route::put('/tasks/{task}', [TaskController::class, 'modifier']);

    // Supprimer une tache specifique
    Route::delete('/tasks/{task}', [TaskController::class, 'supprimer']);

     //Notes
    Route::post('/tasks/{task}/notes', [NoteController::class, 'creeNote']);
    Route::put('/notes/{note}', [NoteController::class, 'modifierNote']);
    Route::delete('/notes/{note}', [NoteController::class, 'supprimerNote']);

    //les taches archivee
    Route::get('/task_archives',[ArchiveController::class, 'afficherArchive']);

});