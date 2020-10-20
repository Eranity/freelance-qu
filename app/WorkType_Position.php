<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType_Position extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'work_type_id',
        'position_id'
    ];
}
