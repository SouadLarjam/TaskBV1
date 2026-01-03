<?php

namespace App\Services;

use App\Repositories\Contracts\NoteRepositoryInterface;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    public function __construct(
        protected NoteRepositoryInterface $noteRepository
    ) {}

    public function create(Task $task, string $content): Note
    {
        return $this->noteRepository->create($task, [
            'content' => $content,
            'user_id' => Auth::id(),
        ]);
    }

    public function update(Note $note, string $content): bool
    {
        return $this->noteRepository->update($note, [
            'content' => $content
        ]);
    }

    public function delete(Note $note): bool
    {
        return $this->noteRepository->delete($note);
    }
}
