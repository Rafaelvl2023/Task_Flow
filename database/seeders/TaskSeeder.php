<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        Task::factory()->count(10)->create()->each(function ($task) use ($projects) {
            if (rand(0, 1)) {
                $task->project_id = $projects->random()->id;
                $task->save();
            }
        });
    }
}
