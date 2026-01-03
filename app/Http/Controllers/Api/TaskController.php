<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 


class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function __construct(private TaskService $taskService){}
    // affichage des task
    public function index(Request $request){
        return response()->json($this->taskService->getUserTasks($request->user()), 200); // afficher juste les tache de l'utilisateur connecter
    }

    // Création d'une tache
    public function cree(StoreTaskRequest $request){
       $task = $this->taskService->create($request->validated(),$request->user());
        return response()->json(['message'=>'Creation réussie',$task]);
    }
     
    // modiffication d'une tache
    public function modifier(UpdateTaskRequest $request, Task $task){
        $this->authorize('update',$task);
        $task = $this->taskService->update($task,$request->validated());
        return response()->json(['message'=>'modification reussie',$task], 200);
    }

    //Supprission du tache
    public function supprimer(Task $task){
        $this->authorize('delete',$task);
        $this->taskService->delete( $task);
        return response()->json(['message'=>'Tache supprimé!'], 200);
    }
    
}
