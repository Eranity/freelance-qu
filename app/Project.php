<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tech_id',
        'description',
        'budget',
        'is_rush',
        'status',
        'created_date',
        'deadline',
        'completion_date',
        'editor_requirements',
        'designer_requirements',
        'templator_requirements'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_date' => 'datetime',
        'completion_date' => 'datetime',
    ];



    public function techCard()
    {
        return $this->hasOne('App\TechCard', 'id', 'tech_id');
    }

    public function executors()
    {
        return $this->belongsToMany('App\User', 'project_executors', 'project_id', 'executor_id');
    }
}
