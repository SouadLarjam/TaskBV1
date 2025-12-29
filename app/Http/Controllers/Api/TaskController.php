<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use Illuminate\Support\Facades\Gate;


class TaskController extends Controller
{
    use AuthorizesRequests;
    // affichage des task
    public function index(Request $request){
        return response()->json($request->user()->tasks()->with('notes.user')->get(), 200); // afficher juste les tache de l'utilisateur connecter
       //return response()->json(Task::with('user')->get(),200); // afficher les taches et leur createur(user) 
       //return response()->json(Task::all(),200); //afficher tous les taches

    }

    // Création d'une tache
    public function cree(Request $request){
        $request->validate(['title'=>'required|string|max:255', 'description'=>'nullable|string','due_date' => 'nullable|date|date_format:Y-m-d H:i:s']);
        $task = Task::create(['title'=>$request->title, 'description'=>$request->description,'due_date' =>$request->due_date, 'user_id'=>$request->user()->id]);
        return response()->json(['message'=>'Creation réussie',$task]);
    }
     
    // modiffication d'une tache
    public function modifier(Request $request, Task $task){
        //seulemment le createur peut modiffier
       /* if ($task->user_id !== $request->user()->id){
            return response()->json(['message'=>'acces refuse'],403);
        }*/

        //$this->authorize('update',$task); -----> return des exceptions standard

        //pour les messages d'erreures personalize
        if (!Gate::allows('update', $task)) {
          return response()->json(['message' => 'Acces refuse : vous n etes pas le créateur de cette tache'], 403);
        }
        $task->update($request->only('title','description','due_date')); //mise a joure task avec les donnee contenu dans $request mais seleument titre, discreption
        return response()->json(['message'=>'modification reussie',$task], 200);
    }

    //Supprission du tache
    public function supprimer(Request $request, Task $task){
        // 
       /* if($task->user_id !== $request->user()->id){
            return response()->json(['message'=>'acces refuse!'],403);
        }*/
        $this->authorize('delete',$task);
        $task->delete();
        return response()->json(['message'=>'Tache supprimé!'], 200);
    }
    
}
