<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectService;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\JsonResponse;
use Exception;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function findProjectById($id): JsonResponse
    {
        try {
            if (empty($id) || !is_string($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID do projeto inválido.',
                    'errors' => ['id' => ['O ID deve ser uma string válida.']]
                ], 400);
            }

            $project = $this->projectService->findProjectById($id);

            if ($project->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Projeto não encontrado.',
                    'errors' => ['project' => ['Projeto com este ID não existe.']]
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Projeto encontrado com sucesso.',
                'data' => new ProjectResource($project->first())
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.',
                'errors' => ['server' => ['Ocorreu um erro inesperado.']]
            ], 500);
        }
    }

    public function listProjects(): JsonResponse
    {
        try {
            $projects = $this->projectService->listProjects();

            return response()->json([
                'success' => true,
                'message' => 'Projetos listados com sucesso.',
                'data' => ProjectResource::collection($projects),
                'total' => $projects->count()
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.',
                'errors' => ['server' => ['Ocorreu um erro inesperado.']]
            ], 500);
        }
    }

    public function create(CreateProjectRequest $request): JsonResponse
    {
        try {
            $project = $this->projectService->createProject($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Projeto criado com sucesso.',
                'data' => new ProjectResource($project)
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar projeto.',
                'errors' => ['server' => ['Ocorreu um erro inesperado durante a criação.']]
            ], 500);
        }
    }

    public function update($id, UpdateProjectRequest $request): JsonResponse
    {
        try {
            if (empty($id) || !is_string($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID do projeto inválido.',
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

            $project = $this->projectService->updateProject($id, $request->validated());

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Projeto não encontrado.',
                    'errors' => ['project' => ['Projeto com este ID não existe.']]
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Projeto atualizado com sucesso.',
                'data' => new ProjectResource($project)
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar projeto. - ' . $e->getMessage(),
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
                    'message' => 'ID do projeto inválido.',
                    'errors' => ['id' => ['O ID deve ser uma string válida.']]
                ], 400);
            }

            $deleted = $this->projectService->deleteProject($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Projeto não encontrado.',
                    'errors' => ['project' => ['Projeto com este ID não existe.']]
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Projeto excluído com sucesso.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
