<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::truncate();

        $group = new Group();
        $group->name = 'base';
        $group->save();

        $group = new Group();
        $group->name = 'user';
        $group->save();

        $group = new Group();
        $group->name = 'settings';
        $group->save();
    }
}
