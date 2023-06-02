<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $table = 'sensor_data';

    private $filter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sensor_id',
        'temperature',
        'power_ok',
        'extra_data',
    ];

    /**
     * The attributes that are mass non assignable.
     *
     * @var array
     */
    protected $nonFillable = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    public function __construct($filter = [])
    {
        $this->setFilter($filter);
    }

    public function setFilter($filter = []) {

        if(empty($filter)) {
            $this->filter = array_merge($this->fillable, $this->nonFillable);
        } else {
            $this->filter = $filter;
        }
    }

    public function getWithFilter($filter = null) {
        if(!empty($filter)) {
            $this->filter = $filter;
        }
    }
}
