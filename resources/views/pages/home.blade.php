@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach ($devices as $device)
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">{{$device->name}}</h5>
                    @foreach ($device->device_sensors as $device_sensor)
                <p class="card-text">{{$device_sensor->sensor_type->name}}: {{$device_sensor->sensor_values->last()->value}} {{$device_sensor->sensor_type->unit}}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection