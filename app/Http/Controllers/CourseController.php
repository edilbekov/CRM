<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'group_id'=>'required',
            'student_id'=>'required',
            'price'=>'required'
        ]);
        $true=Course::create([
            'group_id'=>$request->group_id,
            'student_id'=>$request->student_id,
            'price'=>$request->price
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }
    public function edit(Request $request,$id){
        $request->validate([
            'group_id'=>'required',
            'student_id'=>'required',
            'price'=>'required'
        ]);
        $true=Course::where('id',$id)->update([
            'group_id'=>$request->group_id,
            'student_id'=>$request->student_id,
            'price'=>$request->price
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }
    public function delete($id){
        Course::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view(){
        $all=Course::all();
        return ResponseController::data($all);
    }
}
