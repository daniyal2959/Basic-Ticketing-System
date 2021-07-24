<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class UserType
 * @mixin Builder
 */
class UserType extends Model
{
    protected $table = 'user_type';

    public function users()
    {
        $this->hasMany(User::class, 'UTID');
    }
}
