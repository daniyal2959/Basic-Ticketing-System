<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'TID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }
}
