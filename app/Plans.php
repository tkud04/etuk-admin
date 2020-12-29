<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'name', 'description', 'amount', 'ps_id', 'added_by', 'status'
    ];
}
