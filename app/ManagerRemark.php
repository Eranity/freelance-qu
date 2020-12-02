<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerRemark extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tech_card_id',
        'remark',
        'date'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date'
    ];
}
