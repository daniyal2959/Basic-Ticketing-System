<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Config;
use TypeError;

/**
 * Class Ticket
 * @mixin Builder
 */
class Ticket extends Model
{
    protected $table = 'tickets';

    /**
     * @param TicketStatus|string $status
     * @return string
     */
    public static function rate($status){
        if( !($status instanceof TicketStatus) and !is_string($status) )
            throw new TypeError('The parameter must be instance of TicketStatus or string');


        if( $status instanceof TicketStatus)
            $statusTickets = $status->tickets()->count();
        else
            $statusTickets = TicketStatus::where('name', $status)->first()->tickets()->count();

        $closedTickets = TicketStatus::where('name', Config::get('settings.tickets.closed'))->first()->tickets()->count();

        $rateCount = $statusTickets + $closedTickets;
        $allTicketCount = $rateCount == 0 ? 1 : $rateCount;
        return number_format(($rateCount / $allTicketCount) * 100,1);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'DID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'TSID');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'TID');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'PID');
    }
}
