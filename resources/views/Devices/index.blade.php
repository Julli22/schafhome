@extends('layouts.app')
@section('content')
<table class="table table-borderless table-sm">
    @foreach($devices as $device)
    <tr>
        <td>{{$device->name}}</td>
        <td>
            <table class="table table-borderless table-sm">
                @foreach($device->device_sensors as $device_sensor)
                <tr>
                    <td>{{$device_sensor->sensor_type->name}}</td>
                    <td>
                        <table class="table table-borderless table-sm">
                            @foreach($device_sensor->sensor_values as $sensor_value)
                                <tr>
                                    <td>{{$sensor_value->value . $device_sensor->sensor_type->unit}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
    @endforeach
</table>
@endsection