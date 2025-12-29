<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Note;

class NoteController extends Controller
{
    
    public function creeNote(Request $request, Task $task){
        $request->validate(['content'=>'string']);
        $note= $task->notes()->create(['content'=> $request->content,'user_id'=>$request->user()->id]);
        return response()->json(['message'=>'creation reussie',$note]);
    }

    public function modifierNote(Request $request, Note $note){
        $request->validate(['content'=>'string']);
        $note->update($request->only('content'));
        return response()->json(['message'=>'modification reussie',$note]);
    }

    public function supprimerNote(Request $request, Note $note){
        $note->delete();
        return response()->json(['message'=>'supprission reussie!']);
    }

}
