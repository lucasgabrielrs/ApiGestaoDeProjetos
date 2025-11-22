<?php

namespace App\Http\Services;

use App\Models\Project;

class ProjectService
{
    public function findProjectById($id)
    {
        return Project::where('id', $id)->get();
    }

    public function listProjects()
    {
        return Project::orderBy('created_at', 'desc')->get();
    }

    public function createProject(array $data)
    {
        return Project::create($data);
    }

    public function updateProject($id, array $data)
    {
        $project = Project::find($id);

        if (!$project) {
            throw new \Exception("Projeto não encontrado.");
        }

        $project->update($data);

        return $project->fresh();
    }

    public function deleteProject($id)
    {
        $project = Project::with('tasks')->find($id);

        if (!$project) {
            throw new \Exception("Projeto não encontrado.");
        }

        if (isset($project->tasks) && $project->tasks->isNotEmpty()) {
            foreach ($project->tasks as $task) {
                if ($task->status === 'pending' || $task->status === 'in_progress') {
                    throw new \Exception("Não é possível deletar um projeto com tarefas pendentes ou em andamento.");
                }
            }
        }

        return $project->delete();
    }
}