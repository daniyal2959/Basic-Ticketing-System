<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'UTID');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'UID');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'DID');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'UID');
    }

    public function getTotalOpenedTickets()
    {
        return $this->hasMany(Ticket::class, 'UID')->where('TSID', '=', 1)->count();
    }

    public function getTotalInProgressTickets()
    {
        return $this->hasMany(Ticket::class, 'UID')->where('TSID', '=', 2)->count();
    }

    public function getTotalAnsweredTickets()
    {
        return $this->hasMany(Ticket::class, 'UID')->where('TSID', '=', 3)->count();
    }

    public function getTotalClosedTickets()
    {
        return $this->hasMany(Ticket::class, 'UID')->where('TSID', '=', 4)->count();
    }

}
