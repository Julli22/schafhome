<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SensorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sensor_types')->insert([
            'slug' => 'temperature',
            'name' => 'Celsius',
            'unit' => '°C',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('sensor_types')->insert([
            'slug' => 'humidity',
            'name' => 'Humidity',
            'unit' => '%',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('sensor_types')->insert([
            'slug' => 'pressure',
            'name' => 'Pressure',
            'unit' => 'mbar',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
