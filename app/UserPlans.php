<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlans extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'plan_id', 'status'
    ];
}