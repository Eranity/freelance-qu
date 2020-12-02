<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondSignal extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tech_card_id',

        'number_of_copies',
        'format',

        'total_pages',
        'colored_count',
        'inserts_count',

        'text_paper',
        'text_paper_colorfulness',

        'insert_paper',
        'insert_paper_colorfulness',

        'cover_paper',
        'cover_paper_colorfulness',

        'binding_type',

        'colored_pages',

        'start_date',
        'completed_date',
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'completed_date'
    ];
}
