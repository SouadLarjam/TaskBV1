<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskService {
    public function __construct(private TaskRepositoryInterface $taskRepository){}

    public function getUserTasks(User $user) {
        return $this->taskRepository->getByUser($user->id);
    }

    public function create (array $data, User $user):Task {
        $data['user_id'] = $user->id;
        return $this->taskRepository->create($data);
    }

    public function update(Task $task, array $data): Task {
        return $this->taskRepository->update($task, $data);
    }

    public function delete(Task $task):void {
        $this->taskRepository->delete($task);
    }
}