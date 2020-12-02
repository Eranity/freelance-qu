<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechCard_WorkType extends Model
{
    public $timestamps = false;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tech_card_id',
        'work_type_id',
        'unit_count',

        'start_date',
        'deadline',
        'hours',

        'completed_date',
        'stage_id',
        'responsible_id',
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'deadline',
        'completed_date'
    ];

    public function responsible()
    {
        return $this->belongsTo('App\User', 'responsible_id', 'id');
    }

    public function workType() {
        return $this->belongsTo('App\WorkType', 'work_type_id', 'id');
    }

    // public function stage() {
    //     return $this->belongsTo('App\WorkType', 'work_type_id', 'id');
    // }

}
