<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true
        ]);

        $this->call(ProjectSeeder::class);
        $this->call(TasktypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
