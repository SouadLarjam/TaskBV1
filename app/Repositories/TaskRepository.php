<?php
namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface {
    
    public function getByUser(int $userId) :Collection{
        return Task::where('user_id', $userId)->with('notes.user')->get();
    }

    public function create(array $data): Task {
        return Task::create($data);
    }

    public function update(Task $task, array$data): Task {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task): void {
        $task->delete();
    }
}