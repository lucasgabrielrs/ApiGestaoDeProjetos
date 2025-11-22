<?php

namespace App\Http\Controllers;
use App\Http\Services\TaskService;
use App\Http\Resources\TaskResource;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function findTaskById($id): JsonResponse
    {
        try {
            if (empty($id) || !is_string($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID do projeto inválido.',
                    'errors' => ['id' => ['O ID deve ser uma string válida.']]
                ], 400);
            }

            $task = $this->taskService->findTaskById($id);

            if ($task->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tarefa não encontrada.',
                    'errors' => ['task' => ['Tarefa com este ID não existe.']]
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tarefa encontrada com sucesso.',
                'data' => new TaskResource($task->first())
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.',
                'errors' => ['server' => ['Ocorreu um erro inesperado.']]
            ], 500);
        }
    }

    public function listTasks(): JsonResponse
    {
        try {
            $tasks = $this->taskService->listTasks();

            return response()->json([
                'success' => true,
                'message' => 'Tarefas listadas com sucesso.',
                'data' => TaskResource::collection($tasks),
                'total' => $tasks->count()
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor. - ' . $e->getMessage(),
                'errors' => ['server' => ['Ocorreu um erro inesperado.']]
            ], 500);
        }
    }

    public function listTasksFromProject($projectId): JsonResponse
    {
        try {
            if (empty($projectId) || !is_string($projectId)) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID do projeto inválido.',
                    'errors' => ['project_id' => ['O ID deve ser uma string válida.']]
                ], 400);
            }

            $tasks = $this->taskService->listTasksFromProject($projectId);

            return response()->json([
                'success' => true,
                'message' => 'Tarefas do projeto listadas com sucesso.',
                'data' => TaskResource::collection($tasks),
                'total' => $tasks->count()
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.',
                'errors' => ['server' => ['Ocorreu um erro inesperado.']]
            ], 500);
        }
    }

    public function create(CreateTaskRequest $request): JsonResponse
    {
        try {
            $task = $this->taskService->createTask($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Tarefa criada com sucesso.',
                'data' => new TaskResource($task)
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar tarefa.',
                'errors' => ['server' => ['Ocorreu um erro inesperado durante a criação.']]
            ], 500);
        }
    }

    public function update($id, UpdateTaskRequest $request): JsonResponse
    {
        try {
            if (empty($id) || !is_string($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID da tarefa inválido.',
                    'errors' => ['id' => ['O ID deve ser uma string válida.']]
                ], 400);
            }

            if (empty($request->validated())) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum campo válido para atualizar.',
                    'errors' => ['fields' => ['É necessário enviar pelo menos um campo para atualização.']]
                ], 400);
            }

            $task = $this->taskService->updateTask($id, $request->validated());

            if (!$task) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tarefa não encontrada.',
                    'errors' => ['task' => ['Tarefa com este ID não existe.']]
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tarefa atualizada com sucesso.',
                'data' => new TaskResource($task)
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar tarefa.',
                'errors' => ['server' => ['Ocorreu um erro inesperado durante a atualização.']]
            ], 500);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            if (empty($id) || !is_string($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID da tarefa inválido.',
                    'errors' => ['id' => ['O ID deve ser uma string válida.']]
                ], 400);
            }

            $deleted = $this->taskService->deleteTask($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tarefa não encontrada.',
                    'errors' => ['task' => ['Tarefa com este ID não existe.']]
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tarefa excluído com sucesso.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir tarefa. - ' . $e->getMessage(),
                'errors' => ['server' => ['Ocorreu um erro inesperado durante a exclusão.']]
            ], 500);
        }
    }
}
