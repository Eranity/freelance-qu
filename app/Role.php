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

    /**
     * Get the positions of user.
     */
    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
