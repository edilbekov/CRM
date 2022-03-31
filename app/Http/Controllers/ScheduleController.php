<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function view(){
        $all=Group::all();
        return ResponseController::data($all);
    }
}
