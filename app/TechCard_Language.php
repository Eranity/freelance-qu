<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechCard_Language extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tech_card_id',
        'language'
    ];
}
