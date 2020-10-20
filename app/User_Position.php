<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Position extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'position_id'
    ];
}
