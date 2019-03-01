<?php

namespace App\Http\Controllers;

use App\SensorType;
use App\Device;
use App\SensorValue;
use Validator;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function save(Request $request) {
        $errors = [];
        $data = $request->all();
        if (isset($data['token'])) $data['token'] = md5($data['token']);
        $validation = Validator::make($data, [
            'token' => 'required|string|min:2|max:60|exists:devices,token'
        ]);
        if ($validation->fails()) {
            echo "meh;";
            $errors = $validation->errors()->getMessages();
        }
        if ($validation->passes()) {
            $device = Device::where('token', $data['token'])->first();
            if ($device) {
                if (empty($errors)) {
                    $values = [];
                    $sensorTypes = SensorType::all();
                    foreach ($sensorTypes as $v) {
                        if ($request->has($v->slug)) {
                            $key = $v->slug;
                            $values[$v->id] = $request->$key;
                        }
                    }
                    $result = $this->_writeDB($device, $values);
                    return $result;
                }
            }
        }
        return [
            'error' => $errors,
        ];
    }
    private function _writeDB($device, $values) {
        $result = [];
        foreach ($values AS $typeId => $value) {
            $deviceSensor = $device->getSensorByTypeId($typeId);
            
            if ($deviceSensor) {
                $entry = new SensorValue();
                $entry->device_sensor_id = $deviceSensor->id;
                $entry->value = $value;
                $entry->save();
                $result[] = [
                    'type' => $deviceSensor->sensor_type->slug,
                    'saved' => true
                ];
            }
        }
        return $result;
    }

}
