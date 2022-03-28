<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function add(Request $request){    
        return "dwa";                    
        $request->validate([
            'teacher_id'=>'required',
            'period_id'=>'required',
            'name'=>'required',            
            'days'=>'required',            
            'start_time'=>'required',
            'end_time'=>'required'
        ]);
        $true=Group::create([
            'teacher_id'=>$request->teacher_id,
            'period_id'=>$request->period_id,
            'name'=>$request->name,            
            'days'=>$request->days,            
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time            
        ]);
        return "hello";
        // if($true){
            return ResponseController::success();
        // }
        // return ResponseController::error(['message'=>$true->errors()]);
    }
    public function edit(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'teacher_id'=>'required',
            'days'=>'required',
            'hour'=>'required',
            'start_time'=>'required',
            'end_time'=>'required'
        ]);
        $true=Group::where('id',$id)->update([
            'name'=>$request->name,
            'teacher_id'=>$request->teacher_id,
            'days'=>$request->days,
            'hour'=>$request->hour,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time            
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }
    public function delete($id){
        Group::where('id',$id)->delete();
        return ResponseController::success();
    }
}
