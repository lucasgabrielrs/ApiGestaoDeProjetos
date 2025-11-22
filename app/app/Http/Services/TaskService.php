<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService
{
    public function findTaskById($id)
    {
        return Task::where('id', $id)->get();
    }

    public function listTasks()
    {
        return Task::orderBy('created_at', 'desc')->get();
    }

    public function listTasksFromProject($projectId)
    {
        return Task::where('project_id', $projectId)->orderBy('created_at', 'desc')->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask($id, array $data)
    {
        $task = Task::find($id);

        if (!$task) {
            throw new \Exception("Tarefa não encontrada.");
        }

        $task->update($data);

        return $task->fresh();
    }

    public function deleteTask($id)
    {
        $task = Task::where('id', $id)->first();

        if (!$task) {
            throw new \Exception("Tarefa não encontrada.");
        }

        return $task->delete();
    }
}