<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter todos os projetos existentes
        $projects = Project::all();

        if ($projects->isEmpty()) {
            // Se não há projetos, criar alguns primeiro
            $projects = Project::factory()->count(3)->create();
        }

        // Criar tarefas para cada projeto
        $projects->each(function ($project) {
            // Criar algumas tarefas pendentes
            Task::factory()->pending()->count(rand(2, 4))->create([
                'project_id' => $project->id,
            ]);

            // Criar algumas tarefas em progresso
            Task::factory()->inProgress()->count(rand(1, 3))->create([
                'project_id' => $project->id,
            ]);

            // Criar algumas tarefas concluídas
            Task::factory()->completed()->count(rand(1, 5))->create([
                'project_id' => $project->id,
            ]);

            // Criar algumas tarefas em atraso (apenas algumas)
            if (rand(1, 3) === 1) {
                Task::factory()->overdue()->count(rand(1, 2))->create([
                    'project_id' => $project->id,
                ]);
            }

            // Criar tarefas de alta prioridade (apenas algumas)
            if (rand(1, 2) === 1) {
                Task::factory()->highPriority()->count(1)->create([
                    'project_id' => $project->id,
                ]);
            }
        });

        // Criar algumas tarefas específicas para demonstração
        $firstProject = $projects->first();

        Task::factory()->create([
            'title' => 'Configurar ambiente de desenvolvimento',
            'description' => 'Instalar e configurar todas as dependências necessárias para o projeto.',
            'status' => 'completed',
            'due_date' => now()->subDays(5)->format('Y-m-d'),
            'project_id' => $firstProject->id,
        ]);

        Task::factory()->create([
            'title' => 'Implementar autenticação de usuários',
            'description' => 'Criar sistema completo de login, logout e registro de usuários.',
            'status' => 'in_progress',
            'due_date' => now()->addDays(3)->format('Y-m-d'),
            'project_id' => $firstProject->id,
        ]);

        Task::factory()->create([
            'title' => 'Criar documentação da API',
            'description' => 'Documentar todos os endpoints da API com exemplos de uso.',
            'status' => 'pending',
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'project_id' => $firstProject->id,
        ]);
    }
}