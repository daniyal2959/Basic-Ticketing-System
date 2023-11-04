<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = new User();
        $user->name = "Supporter 1";
        $user->email = "supporter1@gmail.com";
        $user->password = bcrypt('12345678');
        $user->UTID = 1;
        $user->save();

        $user = new User();
        $user->name = "Customer 1";
        $user->email = "customer1@gmail.com";
        $user->password = bcrypt('12345678');
        $user->UTID = 2;
        $user->save();

        $user = new User();
        $user->name = "Daniel Sedighpour";
        $user->email = "daniyal.s.2959@gmail.com";
        $user->password = bcrypt('12345678');
        $user->UTID = 3;
        $user->save();
    }
}
