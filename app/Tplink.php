<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tplink extends Model
{
    use SoftDeletes;

    public $table = 'tplinks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mac',
        'power_mw',
        'total_wh',
        'timestamp',
        'voltage_mv',
        'current_ma',
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
