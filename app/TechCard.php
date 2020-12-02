<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechCard extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'ib_number',
        'isbn',
        'book_name',

        'application_id',
        'edition_id',
        'payment',
        'department',
        'templan',


        'riso_protocol_number',
        'riso_protocol_date',

        'ac_protocol_number',
        'ac_protocol_date',

        'rums_protocol_number',
        'rums_protocol_date',


        'manuscript',

        'total_pages',
        'total_symbols',
        'author_sheet_volume',
        'format',
        'kegel',
        'editing_complexity',
        'layout_complexity',

        'ioot',
        'conclusion',

        'circulation_author',
        'circulation_university',
        'circulation_library',

        'project_manager_id',

        'created_date',
        'appointment_date',

        'status',

        'type'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_date',
        'appointment_date',
        'riso_protocol_date',
        'ac_protocol_date',
        'rums_protocol_date'
    ];

    /**
     * Get the positions of user.
     */
    public function authors()
    {
        return $this->belongsToMany('App\User', 'tech_card__authors', 'tech_card_id', 'author_id');
    }

    public function workTypes()
    {
        return $this->belongsToMany('App\WorkType', 'tech_card__work_types', 'tech_card_id', 'work_type_id')
        ->withPivot('unit_count','id', 'start_date', 'deadline', 'completed_date', 'status', 'responsible_id', 'stage_id', 'status');
    }

    public function works() {
        return $this->hasMany('App\TechCard_WorkType', 'tech_card_id', 'id');
    }

    public function responsible()
    {
        return $this->belongsTo('App\User', 'project_manager_id', 'id');
    }

    public function project()
    {
        return $this->hasOne('App\Project', 'tech_id', 'id');
    }

    public function langaues() {
        return $this->hasMany('App\TechCard_Language', 'tech_card_id', 'id');
    }

    public function isLanguage($language)
    {
        return $this->langaues()->where('language', '=', $language)->exists();
    }

    public function firstSignal() {
        return $this->hasMany('App\FirstSignal', 'tech_card_id', 'id');
    }
}
