<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar alguns projetos específicos para demonstração
        Project::factory()->create([
            'name' => 'Sistema de Gestão de Projetos',
            'owner_name' => 'Tech Solutions Ltda',
        ]);

        Project::factory()->create([
            'name' => 'E-commerce Fashion Store',
            'owner_name' => 'Fashion Digital Corp',
        ]);

        Project::factory()->urgent()->create([
            'name' => 'API de Integração Bancária',
            'owner_name' => 'FinTech Innovations',
        ]);

        // Criar projetos variados usando a factory
        Project::factory()->count(5)->create();

        // Criar projetos específicos por tipo
        Project::factory()->website()->count(3)->create();
        Project::factory()->mobileApp()->count(2)->create();

        // Criar mais alguns projetos urgentes
        Project::factory()->urgent()->count(2)->create();
    }
}