<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Department
 * @mixin Builder
 */
class Department extends Model
{
    protected $table = 'departments';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'DID');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'DID');
    }

    public function getTotalSupporterCount($departmentID)
    {
        return $this->hasMany(User::class, 'DID')->where('DID', '=', $departmentID)->count();
    }

    public function getTotalTicketCount($departmentID)
    {
        return $this->hasMany(Ticket::class, 'DID')->where('DID', '=', $departmentID)->count();
    }

    public function getTotalTicketCountWithStatus($departmentID, $ticketStatus)
    {
        if($ticketStatus == 0){
            return $this->hasMany(Ticket::class, 'DID')->where('DID', '=', $departmentID)->count();
        }

        return $this->hasMany(Ticket::class, 'DID')->where([
            ['TSID', '=', $ticketStatus],
            ['DID', '=', $departmentID]
        ])->count();
    }
}
