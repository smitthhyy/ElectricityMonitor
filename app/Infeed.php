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
        'total',
        'phase_1',
        'phase_2',
        'phase_3',
        'timestamp',
        'created_at',
        'updated_at',
        'deleted_at',
        'updated_by_id',
    ];

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
