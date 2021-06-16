<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement(
            "INSERT INTO `priorities` (`id`, `name`, `created_at`, `updated_at`) VALUES
            (1, 'Urgent', now(), now()),
            (2, 'High', now(), now()),
            (3, 'Normal', now(), now()),
            (4, 'Low', now(), now())"
        );
    }
}
