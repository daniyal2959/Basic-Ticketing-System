<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Ticket
 * @mixin Builder
 */
class Ticket extends Model
{
    protected $table = 'tickets';

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
