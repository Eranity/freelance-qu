<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'rating'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the positions of user.
     */
    public function positions()
    {
        return $this->belongsToMany('App\Position', 'user__positions', 'user_id', 'position_id');
    }

     /**
     * Get the positions of user.
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }


         /**
     * Get the positions of user.
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_executors', 'executor_id', 'project_id');
    }

    public function response()
    {
        return $this->belongsToMany('App\Responce', 'responces', 'executor_id', 'project_id');
    }
}
