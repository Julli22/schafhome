<?php

namespace App\Http\Controllers;

use App\Charts\TemperatureChart;
use App\Device;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $devices = Device::all();
        $charts = array();
        //$chart->labels(['One', 'Two', 'Three', 'Four']);
        //$chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        
        foreach ($devices as $device) {
            foreach ($device->device_sensors as $device_sensor){
                switch ($device_sensor->sensor_type->slug){
                    case 'temperature':
                        $temperatureChart = new TemperatureChart;
                        $temperatureChart->options([
                            'tooltip' => [
                                'show' => true // or false, depending on what you want.
                            ],
                            'legend' => [
                                'padding' => 0
                            ],
                            'color' => 'red',
                            'xAxis' => [
                                'type' => 'category',
                                'axisLine' => [
                                    'show' => true
                                ]
                            ],
                            'yAxis' => [
                                'axisLine' => [
                                    'show' => true
                                ]
                            ],
                            'grid' => [
                                'height' => '200px'
                            ]
                        ]);
                        $datas = array();
                        $labels = array();
                        foreach ($device_sensor->sensor_values as $sensor_value){
                            $datas[] = $sensor_value->value;
                            $labels[] = $sensor_value->created_at->toDateTimeString();
                        }
                        $temperatureChart->labels($labels);
                        $temperatureChart->dataset('Temperatur', 'line', $datas);
                        $charts['temperature'][] = $temperatureChart;
                        break;
                }
            }
        }
        
        return view('pages.home')->with(['devices' => $devices,
        'charts' => $charts]);
    }
}
