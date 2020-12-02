<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $timestamps = [ "created_at" ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_name',
        'budget',
        'file',
        'status'
    ];
}
