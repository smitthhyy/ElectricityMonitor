<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infeed extends Model
{
    use SoftDeletes;

    public $table = 'infeeds';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ch_1',
        'ch_2',
        'ch_3',
        'sensor',
        'timestamp',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
