<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create()
            ->each(function($user) {
                $category = Category::factory()->create();
                Project::factory(4)->create(['user_id' => $user->id])
                    ->each(function($project) use ($category) {
                        $project->categories()->attach(['category_id' => $category->id]);
            });
        });
    }
}
