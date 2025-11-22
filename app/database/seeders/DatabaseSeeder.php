<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Executar seeders na ordem correta
        $this->call([
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);

        $this->command->info('🎉 Banco de dados populado com sucesso!');
        $this->command->info('📊 Dados criados:');
        $this->command->info('   - Projetos: ' . \App\Models\Project::count());
        $this->command->info('   - Tarefas: ' . \App\Models\Task::count());
    }
}