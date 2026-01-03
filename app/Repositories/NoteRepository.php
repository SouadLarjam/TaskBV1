<?php

namespace App\Repositories;

use App\Repositories\Contracts\NoteRepositoryInterface;
use App\Models\Note;
use App\Models\Task;

class NoteRepository implements NoteRepositoryInterface
{
    public function create(Task $task, array $data): Note
    {
        return $task->notes()->create($data);
    }

    public function update(Note $note, array $data): bool
    {
        return $note->update($data);
    }

    public function delete(Note $note): bool
    {
        return $note->delete();
    }
}
