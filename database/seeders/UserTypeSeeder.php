<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userType = new UserType();
        $userType->name = 'Customer';
        $userType->save();

        $userType = new UserType();
        $userType->name = 'Supporter';
        $userType->save();

        $userType = new UserType();
        $userType->name = 'Admin';
        $userType->save();
    }
}
