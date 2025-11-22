<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $taskTitles = [
            'Implementar sistema de login',
            'Criar página de dashboard',
            'Desenvolver API de usuários',
            'Configurar banco de dados',
            'Implementar testes unitários',
            'Criar documentação',
            'Otimizar performance',
            'Configurar deploy',
            'Implementar notificações',
            'Criar interface responsiva',
            'Integrar sistema de pagamento',
            'Configurar SSL',
            'Implementar cache',
            'Criar backup automático',
            'Desenvolver relatórios'
        ];

        $statuses = ['pending', 'in_progress', 'completed', 'cancelled'];

        return [
            'title' => fake()->randomElement($taskTitles),
            'description' => fake()->optional(0.8)->paragraph(rand(1, 3)),
            'due_date' => fake()->optional(0.7)->dateTimeBetween('now', '+30 days'),
            'status' => fake()->randomElement($statuses),
            'project_id' => Project::factory(),
        ];
    }

    /**
     * Create a pending task.
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'due_date' => fake()->dateTimeBetween('+1 days', '+15 days')->format('Y-m-d'),
        ]);
    }

    /**
     * Create an in progress task.
     */
    public function inProgress(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'in_progress',
            'due_date' => fake()->dateTimeBetween('now', '+10 days')->format('Y-m-d'),
        ]);
    }

    /**
     * Create a completed task.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
            'due_date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
        ]);
    }

    /**
     * Create an overdue task.
     */
    public function overdue(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'due_date' => fake()->dateTimeBetween('-15 days', '-1 days')->format('Y-m-d'),
        ]);
    }

    /**
     * Create a high priority task.
     */
    public function highPriority(): static
    {
        return $this->state(fn(array $attributes) => [
            'title' => '[URGENTE] ' . $attributes['title'],
            'due_date' => fake()->dateTimeBetween('now', '+3 days')->format('Y-m-d'),
        ]);
    }

    /**
     * Create a task for a specific project.
     */
    public function forProject(Project $project): static
    {
        return $this->state(fn(array $attributes) => [
            'project_id' => $project->id,
        ]);
    }
}