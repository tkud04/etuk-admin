<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentTerms extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'apartment_id', 'checkin', 'checkout', 'id_required', 'children', 'pets', 'payment_type'
    ];
}
