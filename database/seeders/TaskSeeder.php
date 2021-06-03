<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::take(3)->get();
        
        $projects->each(function($project) {
            Task::factory(2)->create(['project_id' => $project->id]);
        });
    }
}
