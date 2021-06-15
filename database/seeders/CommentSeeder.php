<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::inRandomOrder()->take(10)
            ->each(function($task) {
                Comment::factory(2)->create([
                    'task_id' => $task->id,
                    'user_id' => rand(3, 6)
                ]);
            });
    }
}
