<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Task;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::create([
            'name' => 'Example Project',
            'description' => 'This is a example project.',
        ]);

        Task::create([
            'project_id' => $project->id,
            'name' => 'Task 1',
            'description' => 'Task 1 description',
            'status' => 'todo',
        ]);

        Task::create([
            'project_id' => $project->id,
            'name' => 'Task 2',
            'description' => 'Task 2 description',
            'status' => 'in-progress',
        ]);
    }
}
