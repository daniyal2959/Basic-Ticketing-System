<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class TicketStatus
 * @mixin Builder
 */
class TicketStatus extends Model
{
    protected $table = 'tickets_status';
    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'TSID');
    }
}
