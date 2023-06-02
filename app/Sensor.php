<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public const MIN_SENSOR_ID = 5001;
    /**
     * @var string
     */
    protected $table = 'sensors';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'last_check',
        'enabled',
        'power_status',
        'description',
        'status',
        'min_allowed_temperature',
        'max_allowed_temperature',
        'last_alarm',
        'last_temperature',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
