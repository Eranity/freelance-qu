<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintingDelivery extends Model
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

        'soft_cover_paper',
        'soft_cover_paper_colorfulness',
        'soft_cover_wrap_pressing_type',

        'hard_cover_paper',
        'hard_cover_paper_colorfullness',
        'hard_cover_wrap_pressing_type',

        'soft_binding_count',
        'hard_binding_count',

        'colored_pages',

        'remark',

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
