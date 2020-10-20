<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name'
    ];

    /**
     * Get the allowed positions for the workType.
     */
    public function workTypes()
    {
        return $this->belongsToMany('App\WorkType', 'work_type__positions', 'position_id', 'work_type_id');
    }

    /**
     * Get the positions of user.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user__positions', 'position_id', 'user_id');
    }
}
