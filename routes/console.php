<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Task;
use App\Models\TaskArchive;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('tasks:archive', function () {
    // recuperer toutes les taches dont due_date est passee
    $tasks = Task::where('due_date', '<', now())->get();

    foreach ($tasks as $task) {
        // Copier la tache dans la table d'archive
        TaskArchive::create([
            'user_id' => $task->user_id,
            'title' => $task->title,
            'description' => $task->description,
            'completed' => $task->completed,
            'due_date' => $task->due_date,
        ]);

        // Supprimer la tache originale
        $task->delete();
    }

    $this->info('succes !');
})->purpose('Archive expired tasks automatically');
