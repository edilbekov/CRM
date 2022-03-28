<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class StudentController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name'=>'required|min:3|max:10',
            'surname'=>'required|min:5|max:15',            
            'phone'=>'required|min:9|max:13'
        ]);
        $password=Hash::make($request->name.'123');

        $true=Student::create([
            'name'=>$request->name,
            'surname'=>$request->surname,            
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
            'phone'=>'required|min:9|max:13'
        ]);
        $true=Student::where('id',$id)->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'phone'=>$request->phone            
        ]);
        if($true){
            return ResponseController::success();
        }
        return ResponseController::error(['message'=>$true->errors()]);
    }
    public function delete($id){
        Student::where('id',$id)->delete();
        return ResponseController::success();
    }

}
