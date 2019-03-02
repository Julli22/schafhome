<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $devices = Device::all();

        return view('pages.home')->with(['devices' => $devices]);
    }
}
