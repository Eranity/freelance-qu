<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printing extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tech_card_id',
        'start_date',
        'completed_date',
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'completed_date'
    ];
}
