<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function device_sensors(){
        return $this->hasMany('App\DeviceSensor');
    }
}
