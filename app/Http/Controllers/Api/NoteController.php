<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Task;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class NoteController extends Controller
{
    use AuthorizesRequests;

    public function __construct( protected NoteService $noteService ) {}

    public function creeNote(StoreNoteRequest $request, Task $task)
    {
        $request->validated();
        $note = $this->noteService->create($task, $request->content);

        return response()->json([
            'message' => 'Création réussie',
            'note' => $note
        ]);
    }

    public function modifierNote(UpdateNoteRequest $request, Note $note)
    {
        $this->authorize('update', $note);
        $request->validated();
        $this->noteService->update($note, $request->content);

        return response()->json([
            'message' => 'Modification réussie',
            'note' => $note
        ]);
    }

    public function supprimerNote(Note $note)
    {
        $this->authorize('delete', $note);

        $this->noteService->delete($note);

        return response()->json([
            'message' => 'Suppression réussie'
        ]);
    }
}
