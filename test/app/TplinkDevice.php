<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TplinkDevice extends Model
{
    use SoftDeletes;

    const ONLINE_RADIO = [

    ];

    public $table = 'tplink_devices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ip',
        'mac',
        'port',
        'alias',
        'online',
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
