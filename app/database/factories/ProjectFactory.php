<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projectTypes = [
            'Website',
            'Mobile App',
            'E-commerce',
            'API',
            'Dashboard',
            'Landing Page',
            'Blog',
            'CRM',
            'ERP',
            'Marketplace'
        ];

        $companies = [
            'Tech Solutions',
            'Digital Agency',
            'Startup Inc',
            'Innovation Labs',
            'Creative Studio',
            'Development Corp',
            'Software House',
            'Web Factory'
        ];

        return [
            'name' => fake()->randomElement($projectTypes) . ' ' . fake()->company(),
            'owner_name' => fake()->randomElement($companies),
        ];
    }

    /**
     * Create a project with a specific type.
     */
    public function website(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'Website ' . fake()->company(),
        ]);
    }

    /**
     * Create a mobile app project.
     */
    public function mobileApp(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'App ' . fake()->word() . fake()->randomNumber(2),
        ]);
    }

    /**
     * Create an urgent project.
     */
    public function urgent(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => '[URGENTE] ' . $attributes['name'],
        ]);
    }
}