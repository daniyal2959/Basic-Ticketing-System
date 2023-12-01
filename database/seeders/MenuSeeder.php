<?php

namespace Database\Seeders;

use App\Classes\Module;
use App\Models\Menu;
use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();

        $menu = new Menu();
        $menu->title = 'dashboard';
        $menu->link = route('dashboard.index');
        $menu->icon = 'ni ni-tv-2';
        $menu->color = 'text-primary';
        $menu->group_id = 1;
        $menu->save();

        $menu = new Menu();
        $menu->title = 'all tickets';
        $menu->link = url('/dashboard/tickets');
        $menu->icon = 'ni ni-bullet-list-67';
        $menu->color = 'text-light';
        $menu->group_id = 1;
        $menu->save();

        foreach(TicketStatus::all() as $status){
            $menu = new Menu();
            $menu->title = $status->title;
            $menu->link = route('statusArchive', ['status' => $status->name]);
            $menu->icon = $status->icon_name;
            $menu->color = 'text-' . $status->icon_color;
            $menu->group_id = 1;
            $menu->save();
        }


        $menu = new Menu();
        $menu->title = 'profile';
        $menu->link = route('dashboard.user.userProfile');
        $menu->icon = 'ni ni-paper-diploma';
        $menu->color = 'text-info';
        $menu->group_id = 2;
        $menu->save();

        $menu = new Menu();
        $menu->title = 'users';
        $menu->link = route('dashboard.allUsers');
        $menu->icon = 'ni ni-single-02';
        $menu->color = 'text-pink';
        $menu->group_id = 2;
        $menu->save();

        $menu = new Menu();
        $menu->title = 'modules';
        $menu->link = route('dashboard.modules.allModules');
        $menu->icon = 'ni ni-settings-gear-65';
        $menu->color = 'text-primary';
        $menu->extra = '<span class="badge badge-circle badge-success ml-2">' . Module::count() . '</span>';
        $menu->group_id = 3;
        $menu->save();

        $menu = new Menu();
        $menu->title = 'departments';
        $menu->link = route('dashboard.departments.allDepartments');
        $menu->icon = 'ni ni-building';
        $menu->color = 'text-orange';
        $menu->group_id = 3;
        $menu->save();

        $menu = new Menu();
        $menu->title = 'Priorities';
        $menu->link = route('dashboard.priorities.allPriorities');
        $menu->icon = 'ni ni-chart-bar-32';
        $menu->color = 'text-indigo';
        $menu->group_id = 3;
        $menu->save();

        $menu = new Menu();
        $menu->title = 'Ticket Status';
        $menu->link = route('dashboard.status.allTicketStatuses');
        $menu->icon = 'ni ni-bell-55';
        $menu->color = 'text-green';
        $menu->group_id = 3;
        $menu->save();
    }
}
