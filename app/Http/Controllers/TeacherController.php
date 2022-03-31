<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Teacher;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class TeacherController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',
            'teacher'=>'required',
            'phone'=>'required|min:9|max:13|unique:teachers,phone'            
        ]);
        $password=Hash::make($request->name);

        $true=Teacher::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'teacher'=>$request->teacher,
            'phone'=>$request->phone,
            'password'=>$password
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }
    public function edit(Request $request,$id){        
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',    
            'teacher'=>'required',        
            'phone'=>'required|min:9|max:13'
        ]);
        $true=Teacher::where('id',$id)->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'teacher'=>$request->teacher,
            'phone'=>$request->phone            
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }
    public function delete($id){
        Teacher::where('id',$id)->delete();
        return ResponseController::success();
    }

    public function verification(Request $request,$student_id){
        $verification=$request->verification;
        $group_id=Group::select('id')->where('student_id',$student_id)->first();
        if($verification==true){
            Verification::create([
                'group_id'=>$group_id,
                'student_id'=>$student_id,
                'exist'=>true
            ]);
        }
        elseif($verification==false){
            Verification::create([
                'group_id'=>$group_id,
                'student_id'=>$student_id,
                'exist'=>false
            ]);
        }
        return ResponseController::success();
    }
}
