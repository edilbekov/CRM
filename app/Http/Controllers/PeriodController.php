<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;

class PeriodController extends Controller
{
    public function add(Request $request){
        $period=$request->period;
        $start_time=$request->start_time;
        $finish_time=$request->finish_time;
        Period::create([
            'period'=>$period,
            'start_time'=>$start_time,
            'finish_time'=>$finish_time
        ]);
        return ResponseController::success();
    }
    public function edit(Request $request,$id){
        $period=$request->period;
        $start_time=$request->start_time;
        $finish_time=$request->finish_time;
        Period::where('id',$id)->update([
            'period'=>$period,
            'start_time'=>$start_time,
            'finish_time'=>$finish_time
        ]);        
        return ResponseController::success();        
    }
    public function delete($id){
        Period::where('id',$id)->delete();
        return ResponseController::success();
    }
}
