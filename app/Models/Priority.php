<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priority';
    public $timestamps = false;

    public function ticket()
    {
        $this->hasMany(Ticket::class, 'PID');
    }
}
