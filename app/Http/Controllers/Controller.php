<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function haul2022(){
        return view('haulmassal.2022');
    }
    public function haul2023(){
        return view('haulmassal.2023');
    }
    public function haul2024(){
        return view('haulmassal.2024');
    }
}
