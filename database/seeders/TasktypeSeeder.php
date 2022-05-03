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
        \DB::statement("INSERT INTO `tasktypes` (`name`, `color`, `created_at`, `updated_at`) values 
            ('Feature', 'info', now(), now()),
            ('Fix', 'warning', now(), now()),
            ('Bug', 'danger', now(), now()),
            ('Review', 'success', now(), now())"
        );
    }
}
