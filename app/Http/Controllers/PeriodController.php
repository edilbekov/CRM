<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ResponseController;

class PeriodController extends Controller
{
    public function add(Request $request){
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
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
        $role  = $request->user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
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
        $role  = Auth::user()->role;
        if($role != "admin"){
            return ResponseController::error('No permission', 403);
        }   
        Period::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){
        $periods=Period::select('period','start_time','finish_time')->get();
        return ResponseController::data($periods);
    }
}
