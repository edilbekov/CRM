<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function add(Request $request){
        $validation = Validator::make($request->all(), [
            'full_name'=>'required|min:3|max:30',                        
            'phone'=>'required|min:9|max:13',
            'password'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }      
             
        Student::create([
            'full_name'=>$request->full_name,            
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ]);        
        return ResponseController::success();        
    }
    public function edit(Request $request,$id){             
        $validation = Validator::make($request->all(), [
            'full_name'=>'required|min:3|max:30',                        
            'phone'=>'required|min:9|max:13',
            'password'=>'required'
        ]);

        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(), 422);            
        }

        Student::where('id',$id)->update([
            'full_name'=>$request->full_name,            
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)               
        ]);        
        return ResponseController::success();        
    }
    public function delete($id){
        Student::where('id',$id)->delete();
        return ResponseController::success();
    }
    public function view($group_id){
        $student_ids=Course::select('student_id')->where('group_id',$group_id)->get();
        $students=[];
        foreach($student_ids as $id){
            $students[]=Student::where('id',$id)->first();
        }
        return ResponseController::data($students);
    }
}
