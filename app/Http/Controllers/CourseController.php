<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function add(Request $request){
        $validation = Validator::make($request->all(), [
            'group_id'=>'required',
            'student_id'=>'required',
            'price'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }
        
        Course::create([
            'group_id'=>$request->group_id,
            'student_id'=>$request->student_id,
            'price'=>$request->price
        ]);        
        return ResponseController::success();                
    }
    public function edit(Request $request,$id){
        $validation = Validator::make($request->all(), [
            'group_id'=>'required',
            'student_id'=>'required',
            'price'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }
        Course::where('id',$id)->update([
            'group_id'=>$request->group_id,
            'student_id'=>$request->student_id,
            'price'=>$request->price
        ]);        
        return ResponseController::success();                
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
