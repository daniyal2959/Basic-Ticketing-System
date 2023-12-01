<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(
            [
                UserTypeSeeder::class,
                UserSeeder::class,
                TicketStatusSeeder::class,
                CompanySeeder::class,
                GroupSeeder::class,
                MenuSeeder::class
            ]
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
