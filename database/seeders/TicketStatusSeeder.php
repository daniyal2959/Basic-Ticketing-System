<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketStatus::truncate();

        $status = new TicketStatus();
        $status->title = "Opened";
        $status->name = "openedTicket";
        $status->icon_name = "ni ni-archive-2";
        $status->icon_color = "primary";
        $status->save();

        $status = new TicketStatus();
        $status->title = "In Progress";
        $status->name = "inProgressTicket";
        $status->icon_name = "ni ni-user-run";
        $status->icon_color = "danger";
        $status->save();

        $status = new TicketStatus();
        $status->title = "answered";
        $status->name = "answeredTicket";
        $status->icon_name = "ni ni-support-16";
        $status->icon_color = "yellow";
        $status->save();

        $status = new TicketStatus();
        $status->title = "closed";
        $status->name = "closedTicket";
        $status->icon_name = "ni ni-check-bold";
        $status->icon_color = "success";
        $status->save();
    }
}
