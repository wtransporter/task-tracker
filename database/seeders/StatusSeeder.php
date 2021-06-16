<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement(
            "INSERT INTO `statuses` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
            (1, 'Open', 'info', now(), now()),
            (2, 'Closed', 'secondary', now(), now()),
            (3, 'In progress', 'success', now(), now()),
            (4, 'To do', 'warning', now(), now())"
        );
    }
}
