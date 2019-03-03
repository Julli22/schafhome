@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach ($devices as $key => $device)
            <div class="card mb-5">
                <div class="card-body">
                    <div style="height:300px;">
                        {!! $charts['temperature'][$key]->container() !!}
                        {!! $charts['temperature'][$key]->script() !!}
                    </div>
                    <h5 class="card-title">{{$device->name}}</h5>
                    @foreach ($device->device_sensors as $device_sensor)
                        @if(count($device_sensor->sensor_values) != 0)
                            <p class="card-text">
                                {{$device_sensor->sensor_type->name}}: 
                                {{$device_sensor->sensor_values->last()->value}} 
                                {{$device_sensor->sensor_type->unit}}
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection