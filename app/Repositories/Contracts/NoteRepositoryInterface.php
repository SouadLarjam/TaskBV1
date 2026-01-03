<?php

namespace App\Repositories\Contracts;

use App\Models\Note;
use App\Models\Task;

interface NoteRepositoryInterface
{
    public function create(Task $task, array $data): Note;

    public function update(Note $note, array $data): bool;

    public function delete(Note $note): bool;
}
