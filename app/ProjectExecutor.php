<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectExecutor extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'executor_id'
    ];
}
