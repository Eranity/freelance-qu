<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'unit_type',
        'unit_price',
        'order'
    ];

    /**
     * Get the positions related to the workType.
     */
    public function positions()
    {
        return $this->belongsToMany('App\Position', 'work_type__positions', 'work_type_id', 'position_id');
    }
}
