<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechCard_Author extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'tech_card_id'
    ];
}
