<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function device_sensors(){
        return $this->hasMany('App\DeviceSensor');
    }

    public function getSensorByTypeId($typeId) {
        return DeviceSensor::where('device_id', $this->id)
            ->where('sensor_type_id', $typeId)
            ->first();
    }
}
