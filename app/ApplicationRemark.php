<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationRemark extends Model
{
    public $timestamps = [ "created_at" ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'content',
        'application_id',
        'file',
        'comment',
        'is_answered'
    ];
}
