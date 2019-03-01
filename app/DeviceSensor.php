<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceSensor extends Model
{
    public function sensor_values(){
        return $this->hasMany('App\SensorValue');
    }

    public function sensor_type(){
        return $this->belongsTo('App\SensorType');
    }
}
