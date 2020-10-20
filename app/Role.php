<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends \TCG\Voyager\Models\Role
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name'
    ];
}
