<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TasktypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("INSERT INTO `tasktypes` (`name`, `created_at`, `updated_at`) values 
            ('Feature', now(), now()),
            ('Fix', now(), now()),
            ('Bug', now(), now()),
            ('Review', now(), now())"
        );
    }
}
