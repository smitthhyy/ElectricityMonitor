<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
    use SoftDeletes;

    public $table = 'sensors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'id_field',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function channels()
    {
        return $this->hasMany(Channel::class, 'sensor_id', 'id');
    }
}
